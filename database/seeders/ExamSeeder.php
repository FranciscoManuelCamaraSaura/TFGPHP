<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Group;
use App\Models\Impart;
use App\Models\School;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder {
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
					$teachers = array();
					$subjectsTaught = 0;

					foreach($imparts as $impart) {
						$subject = Subject::getSubjectByCode($impart -> subject);
						$name = "Examen de la asignatura " . $subject -> name . ".";
						$description = "Examen para evaluar los conocimientos adquiridos en la asignatura " . $subject -> name . " dureante la evaluación de este trimestre.";

						if(in_array($impart -> teacher, $teachers)) {
							$subjectsTaught++;
						}

						for($i = 0; $i < 3; $i++) {
							// Evaluaciones generales
							$this -> setPair($school -> id, $subjectsTaught, $impart, $name, $description, 1, $i, 0);
							$this -> setPair($school -> id, $subjectsTaught, $impart, $name, $description, 1, $i, 1);
							$this -> setPair($school -> id, $subjectsTaught, $impart, $name, $description, 2, $i, 0);
	
							// Evaluaciones opcionales
							$this -> setPair($school -> id, $subjectsTaught, $impart, $name, $description, rand(3, 4), $i, 0);
							$this -> setPair($school -> id, $subjectsTaught, $impart, $name, $description, rand(5, 6), $i, 0);
							$teachers[] = $impart -> teacher;
						}
					}
				}
			}

			$it++;
		}
	}

	private function setPair($school, $subjectsTaught, $impart, $name, $description, $typeExam, $evaluation, $version) {
		$date = $this -> getDateEvaluation($this -> setEvaluation($evaluation), $this -> setTypeExam($typeExam), $subjectsTaught, $version);
		$event = $this -> createEvent($school, $date, $impart -> teacher, $name, $description);
		$this -> createExam($impart -> course_id, $impart -> group_words, $event -> id, $impart -> subject, $this -> setTypeExam($typeExam), $this -> setEvaluation($evaluation));
	}

	private function setTypeExam($type) {
		$typeExam = "";

		switch($type) {
			case 1:
				$typeExam = "written";

				break;

			case 2:
				$typeExam = "oral";

				break;

			case 3:
				$typeExam = "presentation";

				break;

			case 4:
				$typeExam = "exhibition";

				break;

			case 5:
				$typeExam = "optional_work";

				break;

			case 6:
				$typeExam = "homework";

				break;
		}

		return $typeExam;
	}

	private function setEvaluation($evaluation) {
		$trimester = "";

		switch($evaluation) {
			case 0:
				$trimester = "first_trimester";

				break;

			case 1:
				$trimester = "second_trimester";

				break;

			case 2:
				$trimester = "third_trimester";

				break;
		}

		return $trimester;
	}

	private function getDateEvaluation($evaluation, $typeExam, $subjectsTaught, $version) {
		$date = "";

		switch($evaluation) {
			case "first_trimester":
				$date = $this -> getDateMonth("/2021", $typeExam, $version, 1);
				$date = $this -> getDateDay($date, $subjectsTaught, 1);

				break;

			case "second_trimester":
				$date = $this -> getDateMonth("/2022", $typeExam, $version, 2);
				$date = $this -> getDateDay($date, $subjectsTaught, 2);

				break;

			case "third_trimester":
				$date = $this -> getDateMonth("/2022", $typeExam, $version, 3);
				$date = $this -> getDateDay($date, $subjectsTaught, 3);

				break;
		}

		return $date;
	}

	private function getDateMonth($date, $typeExam, $version, $evaluation) {
		switch($typeExam) {
			case "written":
				if($evaluation == 1) {
					if($version == 0) {
						$date = "/10" . $date;
					} else {
						$date = "/12" . $date;
					}
				} elseif ($evaluation == 2) {
					if($version == 0) {
						$date = "/01" . $date;
					} else {
						$date = "/03" . $date;
					}
				} else {
					if($version == 0) {
						$date = "/05" . $date;
					} else {
						$date = "/06" . $date;
					}
				}

				break;

			case "oral":
				if($evaluation == 1) {
					$date = "/11" . $date;
				} elseif ($evaluation == 2) {
					$date = "/02" . $date;
				} else {
					$date = "/05" . $date;
				}

				break;

			case "presentation":
				if($evaluation == 1) {
					$date = "/10" . $date;
				} elseif ($evaluation == 2) {
					$date = "/01" . $date;
				} else {
					$date = "/06" . $date;
				}

				break;

			case "exhibition":
				if($evaluation == 1) {
					$date = "/11" . $date;
				} elseif ($evaluation == 2) {
					$date = "/02" . $date;
				} else {
					$date = "/05" . $date;
				}

				break;

			case "optional_work":
				if($evaluation == 1) {
					$date = "/12" . $date;
				} elseif ($evaluation == 2) {
					$date = "/03" . $date;
				} else {
					$date = "/06" . $date;
				}

				break;

			case "homework":
				if($evaluation == 1) {
					$date = "/12" . $date;
				} elseif ($evaluation == 2) {
					$date = "/03" . $date;
				} else {
					$date = "/06" . $date;
				}

				break;
		}

		return $date;
	}

	private function getDateDay($date, $subjectsTaught, $evaluation) {
		switch($subjectsTaught) {
			case 0:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "11" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "15" . $date;
					} else {
						$date = "13" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "14" . $date;
					} else {
						$date = "04" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "09" . $date;
					} else {
						$date = "13" . $date;
					}
				}

				break;

			case 1:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "12" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "16" . $date;
					} else {
						$date = "14" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "15" . $date;
					} else {
						$date = "05" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "10" . $date;
					} else {
						$date = "14" . $date;
					}
				}

				break;

			case 2:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "13" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "17" . $date;
					} else {
						$date = "15" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "16" . $date;
					} else {
						$date = "06" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "11" . $date;
					} else {
						$date = "15" . $date;
					}
				}

				break;

			case 3:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "14" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "18" . $date;
					} else {
						$date = "16" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "17" . $date;
					} else {
						$date = "07" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "12" . $date;
					} else {
						$date = "16" . $date;
					}
				}

				break;

			case 4:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "15" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "19" . $date;
					} else {
						$date = "17" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "18" . $date;
					} else {
						$date = "08" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "13" . $date;
					} else {
						$date = "17" . $date;
					}
				}

				break;

			case 5:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "11" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "15" . $date;
					} else {
						$date = "13" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "14" . $date;
					} else {
						$date = "04" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "09" . $date;
					} else {
						$date = "13" . $date;
					}
				}

				break;

			case 6:
				if($evaluation == 1) {
					if(str_contains($date, '"/10/"')) {
						$date = "13" . $date;
					} elseif (str_contains($date, '"/11/"')) {
						$date = "17" . $date;
					} else {
						$date = "15" . $date;
					}
				} elseif ($evaluation == 2) {
					if(str_contains($date, '"/02/"') || str_contains($date, '"/03/"')) {
						$date = "17" . $date;
					} else {
						$date = "07" . $date;
					}
				} else {
					if(str_contains($date, '"/05/"')) {
						$date = "10" . $date;
					} else {
						$date = "14" . $date;
					}
				}

				break;
		}

		return $date;
	}

	private function createEvent($school, $date, $person, $name, $description) {
		$event = new Event([
			'school' => $school,
			'date' => $date,
			'responsable' => $person,
			'name' => $name,
			'description' => $description,
			'duration' => 1
		]);

		$event -> save();

		return $event;
	}

	private function createExam($course, $group, $event, $subject, $type_exam, $evaluation) {
		$exam = new Exam([
			'course_id' => $course,
			'group_words' => $group,
			'event' => $event,
			'subject' => $subject,
			'type_exam' => $type_exam,
			'evaluation' => $evaluation
		]);

		$exam -> save();
	}
}
