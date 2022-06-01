<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Group;
use App\Models\GroupHavePreceptor;
use App\Models\Impart;
use App\Models\LegalGuardian;
use App\Models\Makes;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller {
	public function index(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		// $output->writeln($request);

		$students = array();
		$studentsOfGroup = array();
		$groups = $request -> groups;
		$course_id = "";
		$group_words = "";

		foreach($groups as $group) {
			foreach($group as $groupElement) {
				if ($course_id === "") {
					$course_id = $groupElement;
				} else {
					$group_words = $groupElement;
				}
			}

			$students = Student::getGroup($course_id, $group_words);

			if (count($students) > 0) {
				$studentsOfGroup = $students;
			}

			$students = array();
			$course_id = "";
			$group_words = "";
		}

		return $studentsOfGroup;
	}

	public function showWeb(Request $request) {
		if(isset($request -> id) && isset($request -> person) && isset($request -> student)) {
			$person = Person::findOrFail($request -> person);
			$student = Student::findOrFail($request -> student);
			$legal_guardian = Person::getDNIPerson($student -> legal_guardian);

			if(isset($request -> subject)) {
				$school = $request -> id;
				$subject = $request -> subject;
				$type_user = $request -> type_user;

				return view("student_file", compact("school", "person", "subject", "student", "legal_guardian", "type_user"));
			} else {
				$school = $request -> id;
				$type_user = $request -> type_user;

				$subjects = $this -> getSubjects($student -> course_id, $student -> group_words);
				$evaluation = $this -> getNotes($student -> id, $student -> course_id, $student -> group_words, $subjects);

				return view("student_file_evaluations", compact("school", "person", "evaluation", "student", "legal_guardian", "type_user"));
			}
		} else {
			return response() -> json(["message" => "Invalid student"], 400);
		}
	}

	private function getNotes($student, $course_id, $group_words, $subjects) {
		$evaluation = array();

		foreach($subjects as $subject) {
			$subjectEvaluation["name"] = Subject::getSubjectByCode($subject) -> name;
			$exams = Exam::getExamsByCourseGroupSubject($course_id, $group_words, $subject);

			$subjectEvaluation["noteFirstTrimester"] = $this -> getNotesByTrimester($student, $exams, "first_trimester");
			$subjectEvaluation["noteSecondTrimester"] = $this -> getNotesByTrimester($student, $exams, "second_trimester");
			$subjectEvaluation["noteThirdTrimester"] = $this -> getNotesByTrimester($student, $exams, "third_trimester");

			$evaluation[] = $subjectEvaluation;
		}

		return $evaluation;
	}

	public function showStudents(Request $request) {
		$courses = array();
		$evaluations = array();

		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			if($type_user === "Teacher") {
				$course_group = GroupHavePreceptor::getByPreceptor($person -> dni);

				$evaluations = $this -> getEvaluations($school, $course_group -> course_id, $course_group -> group_words, $type_user);

				return view("students", compact("school", "person", "courses", "evaluations", "type_user"));
			} else if($type_user === "Manager") {
				$courses = Course::getCourses($school);

				return view("students", compact("school", "person", "courses", "evaluations", "type_user"));
			} else {
				$courses = Course::getCourses($school);

				return view("students_admin", compact("school", "person", "courses", "type_user"));
			}
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function showEvaluations(Request $request) {
		$evaluations = $this -> getEvaluations($request -> school, $request -> course, $request -> group, $request -> type_user);

		return response() -> json(["evaluations" => $evaluations], 200);
	}

	private function getEvaluations($school, $course_id, $group_words, $type_user) {
		$evaluations = array();
		$course = Course::findOrFail($course_id);

		if($course -> school === intval($school)) {
			$students = Student::getGroup($course_id, $group_words);
		}

		if(isset($students)) {
			foreach($students as $student) {
				if ($type_user === "Teacher" || $type_user === "Manager") {
					$subjects = $this -> getSubjects($student -> course_id, $student -> group_words);
					$evaluations[] = $this -> getNotesBySubject($student, $student -> course_id, $student -> group_words, $subjects);
				} else {
					$studentsNotes["id"] = $student -> id;
					$studentsNotes["name"] = $student -> name . " " . $student -> surnames;

					$evaluations[] = $studentsNotes;
				}
			}
		}

		return $evaluations;
	}

	private function getSubjects($course_id, $group_words) {
		$imparts = Impart::getByCourseGroup($course_id, $group_words);

		foreach($imparts as $impart) {
			$subject[] = $impart -> subject;
		}

		return $subject;
	}

	private function getNotesBySubject($student, $course_id, $group_words, $subjects) {
		$firstTrimester = 0.00;
		$secondTrimester = 0.00;
		$thirdTrimester = 0.00;

		$studentsNotes["id"] = $student -> id;
		$studentsNotes["name"] = $student -> name . " " . $student -> surnames;

		foreach($subjects as $subject) {
			$exams = Exam::getExamsByCourseGroupSubject($course_id, $group_words, $subject);

			$firstTrimester += $this -> getNotesByTrimester($student -> id, $exams, "first_trimester");
			$secondTrimester += $this -> getNotesByTrimester($student -> id, $exams, "second_trimester");
			$thirdTrimester += $this -> getNotesByTrimester($student -> id, $exams, "third_trimester");
		}

		$studentsNotes["noteFirstTrimester"] = round($firstTrimester / sizeof($subjects), 2);
		$studentsNotes["noteSecondTrimester"] = round($secondTrimester / sizeof($subjects), 2);
		$studentsNotes["noteThirdTrimester"] = round($thirdTrimester / sizeof($subjects), 2);

		return $studentsNotes;
	}

	private function getNotesByTrimester($student, $exams, $trimestre) {
		$notes = array();
		$average_grade = 0.00;

		if(isset($exams)) {
			foreach($exams as $exam) {
				if($exam -> evaluation === $trimestre) {
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

	public function newStudent(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;
			$courses = Course::getCourses($school);

			return view("new_student", compact("school", "person", "courses", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function insert(Request $request) {
		$request -> validate([
			"legalGuardian" => "required|string",
			"studentName" => "required|string",
			"studentSurnames" => "required|string",
			"course" => "required|string",
			"group" => "required|string",
			"studentPhone" => "required|string",
			"birthday" => "required|string"
		]);

		$student = new Student([
			'legal_guardian' => $request -> legalGuardian,
			'course_id' => $request -> course,
			'group_words' => $request -> group,
			'name' => $request -> studentName,
			'surnames' => $request -> studentSurnames,
			'phone' => $request -> studentPhone,
			'birthday' => $request -> birthday
		]);

		$student -> save();

		return response() -> json($student, 200);
	}

	public function editStudent(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$student = Student::findOrFail($request -> student);
			$legal_guardian = Person::getDNIPerson($student -> legal_guardian);
			$type_user = $request -> type_user;
			$courses = Course::getCourses($school);
			$course_default = Course::findOrFail($student -> course_id);
			$groups = Group::getGroups($student -> course_id);
			$group_default = $student -> group_words;

			return view("edit_student", compact("school", "person", "student", "legal_guardian", "courses", "course_default", "groups", "group_default", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function update(Request $request) {
		$student = Student::findOrFail($request -> student);

		$request -> validate([
			"legalGuardian" => "required|string",
			"studentName" => "required|string",
			"studentSurnames" => "required|string",
			"course" => "required|string",
			"group" => "required|string",
			"studentPhone" => "required|string",
			"birthday" => "required|string"
		]);

		$student -> legal_guardian = $request -> input("legalGuardian");
		$student -> course_id = $request -> input("course");
		$student -> group_words = $request -> input("group");
		$student -> name = $request -> input("studentName");
		$student -> surnames = $request -> input("studentSurnames");
		$student -> phone = $request -> input("studentPhone");
		$student -> birthday = $request -> input("birthday");

		$student -> save();

		return response() -> json($student, 200);
	}

	public function delete(Request $request) {
		$student = Student::findOrFail($request -> student);
		$legal_guardian = LegalGuardian::getDNIPerson($student -> legal_guardian);
		$person = Person::getDNIPerson($student -> legal_guardian);

		$student -> delete();
		$legal_guardian -> delete();
		$person -> delete();

		return response() -> json(200);
	}

	public function showApi(Request $request) {
		$datosURL = explode("/", $request -> getRequestUri());
		$student = Student::getLegalGuaridan($datosURL[3]);

		return response() -> json($student, 200);
	}

	/*public function show(Request $request) {
		$studentsOfGroup = [];
		$students = [];
		$groups = $request -> json() -> all();

		foreach($groups as $group) {
			foreach($group as $groupElement) {//print_r($groupElement);
				$studentsOfGroup[] = Student::find($groupElement);
			}print_r($studentsOfGroup);

			foreach($studentsOfGroup as $student) {
				$students[] = $student;
			}
		}

		return $students;
	}*/
}