<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\GroupHavePreceptor;
use App\Models\Impart;
use App\Models\Person;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller {
	public function showWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		// $output->writeln($request);

		if (isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;
			$courses = Course::getCourses($request -> id);

			if($type_user === "Manager") {
				return view("teachers", compact("school", "courses", "person", "type_user"));
			} else {
				return view("teachers_admin", compact("school", "courses", "person", "type_user"));
			}
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function showTeacher(Request $request) {
		$subjects = array();

		$school = $request -> id;
		$person = Person::findOrFail($request -> person);
		$type_user = $request -> type_user;
		$teacher = Person::findOrFail($request -> teacher);

		$imparts = Impart::getSubjects($teacher -> dni);

		foreach($imparts as $impart) {
			$course = Course::findOrFail($impart -> course_id);

			if($course -> school === $school) {
				$subject["name"] = Subject::getSubjectByCode($impart -> subject) -> name;
				$subject["course"] = $course -> number;
				$subject["degree"] = $course -> degree;
				$subject["group"] = $impart -> group_words;

				$subjects[] = $subject;
			}
		}

		return view("teacher_file", compact("school", "person", "teacher", "subjects", "type_user"));
	}

	public function showTeachers(Request $request) {
		$teachers = array();
		$imparts = Impart::getByCourseGroup($request -> course, $request -> group);

		foreach($imparts as $impart) {
			$person = Person::getDNIPerson($impart -> teacher);
			$subject = Subject::getSubjectByCode($impart -> subject);

			$teacher["id"] = $person -> id;
			$teacher["teacherName"] = $person -> name . " " . $person -> surnames;
			$teacher["code"] = $subject -> code;
			$teacher["subjectName"] = $subject -> name;

			$teachers[] = $teacher;
		}

		return response() -> json(["teachers" => $teachers], 200);
	}

	public function showApi(Request $request) {
		if (is_string($request -> teachers_id)) {
			$teachers_id = explode(", ", $request -> teachers_id);

			foreach($teachers_id as $teacher) {
				$teachers[] = Person::getDNIPerson($teacher);
			}
		} else {
			foreach($request -> teachers_id as $teacher) {
				$teachers[] = Person::getDNIPerson($teacher);
			}
		}

		return response() -> json($teachers, 200);
	}

	public function login(Request $request) {
		if (isset($request -> id) && isset($request -> teacher)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> teacher);
			$teacher = Teacher::getDNIPerson($person -> dni);
			$type_user = "Teacher";

			return view("home", compact("school", "person", "teacher", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function insert(Request $request) {
		$request -> validate([
			"teacher" => "required|string",
		]);

		$teacher = new Teacher([
			'person' => $request -> teacher,
			'user_name' => $request -> teacher,
			'password' => "1234",
			'preceptor' => $request -> preceptor
		]);

		$teacher -> save();

		return response() -> json($teacher, 200);
	}

	public function update(Request $request) {
		$person = Person::findOrFail($request -> person);
		$teacher = Teacher::getDNIPerson($person -> dni);

		if($teacher -> password === $request -> oldPassword) {
			$teacher -> password = $request -> input('newPassword');

			$teacher -> save();

			return response() -> json($teacher, 200);
		} else {
			return response() -> json(["message" => "The new password must be different"], 200);
		}
	}

	public function newTeacher(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;
			$courses = Course::getCourses($school);

			return view("new_teacher", compact("school", "person", "courses", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function editTeacher(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$subjects = array();
	
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$teacher = Person::findOrFail($request -> teacher);
			$type_user = $request -> type_user;
			$imparts = Impart::getCoursesGroups($teacher -> dni);

			$course_default = Course::findOrFail($imparts[0] -> course_id);
			$group_default = $imparts[0] -> group_words;

			foreach($imparts as $impart) {
				$subjects_impart[] = Subject::getSubjectByCode($impart -> subject);
			}

			$subjects = $this -> getByDegree($course_default -> degree, $course_default -> number, $group_default);

			$courses = Course::getCourses($school);
			$groups = Group::getGroups($course_default -> number);
			$is_preceptor = Teacher::getDNIPerson($teacher -> dni) -> preceptor;

			return view("edit_teacher", compact("school", "person", "teacher", "courses", "course_default", "groups", "group_default", "subjects_impart", "subjects", "is_preceptor", "type_user"));
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

	public function delete(Request $request) {
		$person = Person::findOrFail($request -> teacher);
		$preceptor = GroupHavePreceptor::getByPreceptor($person -> dni);
		$teacher = Teacher::getDNIPerson($person -> dni);

		if(isset($preceptor -> preceptor)) {
			$preceptor -> delete();
		}

		$teacher -> delete();
		$person -> delete();

		return response() -> json(200);
	}
}
