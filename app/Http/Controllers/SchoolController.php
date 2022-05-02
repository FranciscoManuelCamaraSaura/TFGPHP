<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Impart;
use App\Models\Manager;
use App\Models\Person;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SchoolController extends Controller {
	public function index() {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		$schools = School::all();

		return response() -> json($schools, 200);
	}

	public function show(Request $request) {
		$school = School::findOrFail($request -> id);

		return response() -> json($school, 200);
	}

	public function provinces() {
		$schools = School::all();
		$provinces = array();
		$person = "";

		foreach($schools as $school) {
			if (!in_array($school -> province, $provinces)) {
				$provinces[] = $school -> province;
			}
		}

		return view("pre_login", compact("provinces", "person"));
	}

	public function locations(Request $request) {
		$locations = array();

		if (isset($request -> province)) {
			$schools = School::getLocationsByProvince($request -> province);

			foreach($schools as $school) {
				$locations[] = $school -> location;
			}

			return response() -> json(["locations" => $locations], 200);
		} else {
			return response() -> json(["message" => "Invalid province"], 400);
		}
	}

	public function schools(Request $request) {
		$schoolsId = array();
		$schoolsName = array();

		if (isset($request -> location)) {
			$schools = School::getSchoolsByLocation($request -> location);

			foreach($schools as $school) {
				$schoolsId[] = $school -> id;
				$schoolsName[] = $school -> name;
			}

			return response() -> json([
				"schoolsId" => $schoolsId,
				"schoolsName" => $schoolsName
			], 200);
		} else {
			return response() -> json(["message" => "Invalid location"], 400);
		}
	}

	public function school(Request $request) {
		if (isset($request -> id)) {
			$school = School::findOrFail($request -> id);
			$person = "";

			return view("login", compact("school", "person"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function login(Request $request) {
		$request -> validate([
			"type_user" => "required|string",
			"user_name" => "required|string",
			"password" => "required|string"
		]);

		$managers = Manager::getManagerBySchool($request -> school_id);
		$courses = Course::getCourses($request -> school_id);

		foreach($courses as $course) {
			$groups = Group::getGroups($course -> id);

			foreach($groups as $group) {
				$teachersImparts[] = Impart::getTeachers($course -> id, $group -> group_words);
			}
		}

		switch($request -> type_user) {
			case "Super Admin":

				break;

			case "Manager":
				return $this -> managerValidations($request, $managers);

				break;

			case "Teacher":
				return $this -> teacherValidations($request, $teachersImparts);

				break;
		}
	}

	private function managerValidations($request, $managers) {
		$is_manager_in_school = false; // Manager: 12597706M

		$manager = Manager::getManagerLogin($request -> user_name, $request -> password);

		if (isset($manager)) {
			foreach($managers as $managerAtSchool) {
				if ($manager -> person === $managerAtSchool -> person) {
					$is_manager_in_school = true;
				}
			}

			if ($is_manager_in_school) {
				$person = Person::getDNIPerson($manager -> person);

				return response() -> json(["message" => $person], 400);
			} else {
				return response() -> json(["message" => "Invalid manager at selected school"], 400);
			}
		} else {
			$manager = Manager::getManagerByUserName($request -> user_name);

			if (!isset($manager)) {
				return response() -> json(["message" => "Invalid user name"], 400);
			} else {
				return response() -> json(["message" => "Invalid password"], 400);
			}
		}
	}

	private function teacherValidations($request, $teachersImparts) {
		$is_teacher_in_school = false; // Teacher: 98766703N

		$teacher = Teacher::getTeacherLogin($request -> user_name, $request -> password);

		if (isset($teacher)) {
			foreach($teachersImparts as $imparts) {
				foreach($imparts as $impart) {
					if ($teacher -> person === $impart) {
						$is_teacher_in_school = true;
					}
				}
			}

			if ($is_teacher_in_school) {
				$person = Person::getDNIPerson($teacher -> person);

				return response() -> json(["message" => $person], 400);
			} else {
				return response() -> json(["message" => "Invalid teacher at selected school"], 400);
			}
		} else {
			$teacher = Teacher::getTeacherByUserName($request -> user_name);

			if (!isset($teacher)) {
				return response() -> json(["message" => "Invalid user name"], 400);
			} else {
				return response() -> json(["message" => "Invalid password"], 400);
			}
		}
	}
}
