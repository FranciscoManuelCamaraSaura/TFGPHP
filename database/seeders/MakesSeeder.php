<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Impart;
use App\Models\Makes;
use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Seeder;

class MakesSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$schools = School::get();

		$it = 0;

		foreach($schools as $school) {
			if ($it > 1) {
				return;
			}

			$courses = Course::getCourses($school -> id);

			foreach($courses as $course) {
				$groups = Group::getGroups($course -> id);

				foreach($groups as $group) {
					$imparts = Impart::getByCourseGroup($group -> course_id, $group -> group_words);
					$students = Student::getGroup($group -> course_id, $group -> group_words);

					foreach($imparts as $impart) {
						$exams = Exam::getExamsByCourseGroupSubject($impart -> course_id, $impart -> group_words, $impart -> subject);

						foreach ($exams as $exam) {
							foreach ($students as $student) {
								$this -> makeExam($student -> id, $exam -> id);
							}
						}
					}
				}
			}

			$it++;
		}
	}

	private function makeExam($student, $exam) {
		$exam = new Makes([
			'student' => $student,
			'exam' => $exam,
			'note' => $this -> randomFloat()
		]);

		$exam -> save();
	}

	private function randomFloat() {
		return random_int(0, 1000)/100;
	}
}
