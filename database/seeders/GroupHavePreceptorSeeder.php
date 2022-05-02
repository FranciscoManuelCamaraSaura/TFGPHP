<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupHavePreceptor;
use App\Models\Person;
use Illuminate\Database\Seeder;

class GroupHavePreceptorSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$courses = Course::get();

		foreach($courses as $course) {
			$groups = Group::getGroups($course -> id);

			if($course -> school == 1 || $course -> school == 2) {
				foreach($groups as $group) {
					$name = $this -> getDegree($course -> degree);
					$person = Person::getTeacherByName("Preceptor " . $course -> number . " " . $group -> group_words . " " . $name);

					$this -> makeGroupHavePreceptor($course -> id, $group -> group_words, $person -> dni);
				}
			}
		}
	}

	public function getDegree($degree) {
		switch($degree) {
			case "preschool":
				$name = "PRE";
				
				break;

			case "primary":
				$name = "PRI";

				break;

			case "secundary":
				$name = "SEC";

				break;

			case "bachelor":
				$name = "BACH";

				break;
		}

		return $name;
	}

	public function makeGroupHavePreceptor($course_id, $group_words, $dni) {
		$groupHavePreceptor = new GroupHavePreceptor([
			'course_id' => $course_id,
			'group_words' => $group_words,
			'preceptor' => $dni
		]);

		$groupHavePreceptor -> save();
	}
}
