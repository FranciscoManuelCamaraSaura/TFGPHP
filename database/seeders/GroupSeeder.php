<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Group;
use App\Models\LegalGuardian;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table("group") -> delete();

		$courses = Course::get();
		$group_words = ["A", "B", "C", "D"];

		foreach($courses as $course) {
			if($course -> degree !== "bachelor") {
				$totalGroups = 3;
			} else {
				$totalGroups = 4;
			}

			for($i = 0; $i < $totalGroups; $i++) {
				$group = new Group([
					"course_id" => $course -> id,
					"group_words" => $group_words[$i]
				]);

				$group -> save();

				if($course -> school == 1 || $course -> school == 2) {
					for($j = 0; $j < 10; $j++) {
						$this -> makeStudent($j, $course -> id, $group_words[$i], $course -> degree);
					}
				}
			}
		}
	}

	private function makeStudent($studenNumber, $course, $group, $degree) {
		$person = $this -> makeLegalGuardian($studenNumber, $course, $group, $degree);

		$student = new Student([
			"legal_guardian" => $person -> dni,
			"course_id" => $course,
			"group_words" => $group,
			"name" => "Student" . $studenNumber . " " . $course . " " . $group,
			"surnames" => $degree,
			"phone" => $person -> phone,
			"birthday" => "01/01/2017 00:00:00"
		]);

		$student -> save();
	}

	private function makeLegalGuardian($studenNumber, $course, $group, $degree) {
		$legalGuardian = LegalGuardian::factory() -> make();
		$person = Person::getDNIPerson($legalGuardian -> person);

		$legalGuardian -> user_name = $legalGuardian -> person;
		$person -> name = "Legal guardian " . $studenNumber . " " . $course . " " . $group;
		$person -> surnames = $degree;

		$person -> save();
		$legalGuardian -> save();

		return $person;
	}
}
