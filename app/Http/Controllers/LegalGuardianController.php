<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\LegalGuardian;
use App\Models\Student;
use Illuminate\Http\Request;

class LegalGuardianController extends Controller {
	public function login(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		// $output->writeln($request);
		$courses = Course::getCourses($request -> school_id);
		$legalGuardian = LegalGuardian::getLegalGuardianLogin($request -> user_name, $request -> password);

		if ($legalGuardian !== null) {
			foreach($courses as $course) {
				$groups = Group::getGroups($course -> id);

				foreach($groups as $group) {
					$students = Student::getGroup($group -> course_id, $group -> group_words);

					foreach($students as $student) {
						if ($legalGuardian -> person === $student -> legal_guardian) {
							if ($request -> user_name === $legalGuardian -> user_name
								&& $request -> password === $legalGuardian -> password) {
									return response()->json($legalGuardian, 200);
							} else if ($request -> user_name !== $legalGuardian -> user_name) {
								return response()->json(['type' => 'user_name', 'message' => 'Invalid user_name'], 400);
							} else if ($request -> password !== $legalGuardian -> password) {
								return response()->json(['type' => 'password', 'message' => 'Invalid password'], 400);
							}
						}
					}
				}
			}

			return response() -> json(['type' => 'user', 'message' => 'Invalid user'], 400);
		} else {
			$legalGuardianUserName = LegalGuardian::getLegalGuardianUserName($request -> user_name);

			if ($legalGuardianUserName === null) {
				return response() -> json(['type' => 'user_name', 'message' => 'Invalid user_name'], 400);
			} else {
				return response() -> json(['type' => 'password', 'message' => 'Invalid password'], 400);
			}
		}
	}

	public function insert(Request $request) {
		$request -> validate([
			"legalGuardian" => "required|string",
		]);

		$legalGuardian = new LegalGuardian([
			'person' => $request -> legalGuardian,
			'user_name' => $request -> legalGuardian,
			'password' => "1234"
		]);

		$legalGuardian -> save();

		return response() -> json($legalGuardian, 200);
	}

	public function update(Request $request) {
		$legalGuardian = LegalGuardian::getDNIPerson($request -> person);

		if ($legalGuardian -> user_name === $request -> user_name) {
			$legalGuardian -> password = $request -> input('password');

			$legalGuardian -> save();

			return response() -> json($legalGuardian, 200);
		} else {
			return response() -> json(['type' => 'user_name', 'message' => 'Invalid user_name'], 400);
		}
	}
}
