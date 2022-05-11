<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Impart;
use App\Models\Makes;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller {
	public function showWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		// $output->writeln($request);

		$courses = array();
		$groups = array();
		$subjects = array();

		if(isset($request -> id) && isset($request -> person)) {
			$person = Person::findOrFail($request -> person);
			$imparts = Impart::getSubjects($person -> dni);
			$school = $request -> id;
			$type_user = $request -> type_user;

			foreach ($imparts as $impart) {
				$course = Course::findOrFail($impart -> course_id);

				if($course -> school === $school) {
					$subjects[] = Subject::getSubjectByCode($impart -> subject);
					$courses[] = $course;
					$groups[] = $impart -> group_words;
					$students[] = Student::getGroup($impart -> course_id, $impart -> group_words) -> count();
				}
			}

			return view("subjects", compact("school", "person", "subjects", "courses", "groups", "students", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function showSubject(Request $request) {
		$imparts = array();
		$teachers = array();
		$evaluations = array();

		if(isset($request -> id) && isset($request -> person) && isset($request -> code)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$subject = Subject::getSubjectByCode($request -> code);
			$type_user = $request -> type_user;

			if($type_user === "Teacher") {
				$imparts = Impart::getCourseGroup($request -> code, $person -> dni);
			} else if($type_user === "Manager" || $type_user === "Admin") {
				$imparts = Impart::getTeachersBySubject($request -> code);
			}

			foreach ($imparts as $impart) {
				$course = Course::findOrFail($impart -> course_id);

				if($course -> school === $school && $type_user === "Teacher") {
					$students = Student::getGroup($impart -> course_id, $impart -> group_words);
				} else if($course -> school === $school && ($type_user === "Manager" || $type_user === "Admin")) {
					$teachers[] = Person::getDNIPerson($impart -> teacher);
				}
			}

			$evaluation = array();

			if($type_user === "Teacher") {
				foreach($students as $student) {
					$evaluations[] = $this -> getNotesBySubject($student, $student -> course_id, $student -> group_words, $subject -> code);
				}
			}

			return view("subject_file", compact("school", "person", "subject", "teachers", "evaluations", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	private function getNotesBySubject($student, $course_id, $group_words, $subject) {
		$firstTrimester = 0.00;
		$secondTrimester = 0.00;
		$thirdTrimester = 0.00;

		$studentsNotes["id"] = $student -> id;
		$studentsNotes["name"] = $student -> name . " " . $student -> surnames;

		$exams = Exam::getExamsByCourseGroupSubject($course_id, $group_words, $subject);

		if(isset($exams)) {
			$firstTrimester = $this -> getNotesByTrimester($student -> id, $exams, "first_trimester");
			$secondTrimester = $this -> getNotesByTrimester($student -> id, $exams, "second_trimester");
			$thirdTrimester = $this -> getNotesByTrimester($student -> id, $exams, "third_trimester");
		}

		$studentsNotes["noteFirstTrimester"] = $firstTrimester;
		$studentsNotes["noteSecondTrimester"] = $secondTrimester;
		$studentsNotes["noteThirdTrimester"] = $thirdTrimester;

		$studentsNotes["noteOptionalWork"] = $this -> getNotesByOtherCalifications($student -> id, $exams, "optional_work", "homework");
		$studentsNotes["noteOptionalWork"] = $this -> getNotesByOtherCalifications($student -> id, $exams, "presentation", "exhibition");

		$studentsNotes["finalNote"] = $this -> getFinalNote($firstTrimester, $secondTrimester, $thirdTrimester);

		return $studentsNotes;
	}

	private function getNotesByTrimester($student, $exams, $trimestre) {
		$notes = array();
		$average_grade = 0.00;

		foreach($exams as $exam) {
			if($exam -> evaluation === $trimestre && ($exam -> type_exam === "written" || $exam -> type_exam === "oral")) {
				$notes[] = Makes::getNote($student, $exam -> id) -> note;
			}
		}

		if(sizeof($notes) > 0) {
			foreach ($notes as $note) {
				$average_grade += $note;
			}

			$average_grade = round($average_grade / sizeof($notes), 2);
		}

		return $average_grade;
	}

	private function getNotesByOtherCalifications($student, $exams, $type_exam1, $type_exam2) {
		$notes = array();
		$average_grade = 0.00;

		if(isset($exams)) {
			foreach($exams as $exam) {
				if($exam -> type_exam === $type_exam1 || $exam -> type_exam === $type_exam2) {
					$notes[] = Makes::getNote($student, $exam -> id) -> note;
				}
			}

			if(sizeof($notes) > 0) {
				foreach ($notes as $note) {
					$average_grade += $note;
				}

				$average_grade = round($average_grade / sizeof($notes), 2);
			}
		}

		return $average_grade;
	}

	private function getFinalNote($firstTrimester, $secondTrimester, $thirdTrimester) {
		$average_grade = 0.00;

		if(isset($firstTrimester) && isset($secondTrimester) && isset($thirdTrimester)) {
			$average_grade = $firstTrimester + $secondTrimester + $thirdTrimester;
			$average_grade = round($average_grade / 3, 2);
		}

		return $average_grade;
	}

	public function showSubjects(Request $request) {
		if(isset($request -> school) && isset($request -> person)) {
			$subjects = array();

			$person = Person::findOrFail($request -> person);

			if($request -> type_user === "Teacher") {
				$imparts = Impart::getSubject($request -> course, $request -> group, $person -> dni);

				foreach ($imparts as $impart) {
					$subjects[] = Subject::getSubjectByCode($impart -> subject);
				}
			} else if($request -> type_user === "Manager") {
				$imparts = Impart::getByCourseGroup($request -> course, $request -> group);

				foreach ($imparts as $impart) {
					$subjects[] = Subject::getSubjectByCode($impart -> subject);
				}
			} else {
				$course = Course::findOrFail($request -> course);
				$subjects = $this -> getByDegree($course -> degree, $course -> number, $request -> group);
			}

			return response() -> json(["subjects" => $subjects], 200);
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	private function getByDegree($degree, $number, $group) {
		switch($degree) {
			case "preschool":
				$subjects = Subject::getSubjectByDegreeCourse($degree, $number);
				break;

			case "primary":
				$subjects = Subject::getSubjectByDegree($degree);
				break;

			case "secundary":
				if($number == 3) {
					$subjects = Subject::getSubjectByDegreeCourseWord($degree, $number, $group);
				} else {
					$subjects = Subject::getSubjectByDegreeCourse($degree, $number);
				}

				break;
			
			case "bachelor":
				$subjects = Subject::getSubjectByDegreeCourseWord($degree, $number, $group);
				break;
		}

		return $subjects;
	}

	public function showApi(Request $request) {
		if (is_string($request -> subjects_id)) {
			$subjects_id = explode(", ", $request -> subjects_id);

			foreach($subjects_id as $subject) {
				$subjects[] = Subject::getSubjectByCode($subject);
			}
		} else {
			foreach($request -> subjects_id as $subject) {
				$subjects[] = Subject::getSubjectByCode($subject);
			}
		}
	
		return response()->json($subjects, 200);
	}
}
