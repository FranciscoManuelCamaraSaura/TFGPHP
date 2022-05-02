<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Impart;
use App\Models\Person;
use Illuminate\Http\Request;

class GroupController extends Controller {
	public function index(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		$groups = Group::all();

		foreach($request -> courses_id as $course) {
			foreach($groups as $group) {
				if (intval($group -> course_id) === $course) {
					$groupsOfCourses[] = $group;
				}
			}
		}

		return $groupsOfCourses;
	}

	public function show(Request $request) {
		$group = Group::getGroup($request -> course_id, $request -> group_words);

		return response() -> json($group, 200);
	}

	public function showGroups(Request $request) {
		if(isset($request -> school) && isset($request -> person)) {
			$groups = array();

			if($request -> type_user === "Teacher") {
				$person = Person::findOrFail($request -> person);
				$course = Course::findOrFail($request -> course);

				$imparts = Impart::getCoursesGroups($person -> dni);

				foreach ($imparts as $impart) {
					if ($course -> id == $impart -> course_id && !in_array($impart -> group_words, $groups)) {
						$groups[] = $impart -> group_words;
					}
				}
			} else {
				$groups_words = Group::getGroups($request -> course);

				foreach ($groups_words as $group) {
					$groups[] = $group -> group_words;
				}
			}

			return response() -> json(["groups" => $groups], 200);
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}
}
