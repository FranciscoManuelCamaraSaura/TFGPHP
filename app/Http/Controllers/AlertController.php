<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Course;
use App\Models\Group;
use App\Models\Impart;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class AlertController extends Controller {
	public function showWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		$groups = array();
		$subjects = array();

		if (isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$alerts = Alert::getSender($person -> dni);
			$type_user = $request -> type_user;

			$courses = $this -> getCourses($school, $person, $type_user);

			if (isset($alerts)) {
				$alerts_sent = array();

				foreach ($alerts as $alert) {
					$student = Student::getLegalGuaridan($alert -> receiver);

					$alert_data["alert"] = $alert -> id;
					$alert_data["student"] = $student[0] -> name . " " . $student[0] -> surnames;
					$alert_data["matter"] = $alert -> matter;
					$alert_data["read"] = $alert -> read;
					$alerts_sent[] = $alert_data;
				}
			}

			if (isset($request -> subject) && isset($request -> student)) {
				$student = Student::findOrFail($request -> student);
				$subject_default = Subject::getSubjectByCode($request -> subject);
				$subjects[] = $subject_default;
				$course_default = $student -> course_id;
				$groups = Group::getGroups($student -> course_id);
				$group_default = $student -> group_words;
			} else if (isset($request -> student)) {
				$student = Student::findOrFail($request -> student);

				if($type_user === "Teacher") {
					$imparts = Impart::getSubject($student -> course_id, $student -> group_words, $person -> dni);
				} else {
					$imparts = Impart::getByCourseGroup($student -> course_id, $student -> group_words);
				}

				foreach($imparts as $impart) {
					$subjects[] = Subject::getSubjectByCode($impart -> subject);
				}

				$subject_default = $subjects[0];
				$course_default = $student -> course_id;
				$groups = Group::getGroups($student -> course_id);
				$group_default = $student -> group_words;
			} else {
				$student = "";
				$subject_default = "";
				$course_default = "";
				$group_default = "";
			}

			return view("alerts", compact("school", "person", "courses", "groups", "subjects", "course_default", "group_default", "subject_default", "student", "alerts_sent", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function showApi(Request $request) {
		$alertReceiver = Alert::getReceiver($request -> receiver);

		return response() -> json($alertReceiver, 200);
	}

	public function updateRead(Request $request) {
		$alert = Alert::findOrFail($request -> id);

		$alert -> read = true;

		$alert -> save();

		return response() -> json($alert, 200);
	}

	public function getCourses($school, $person, $type_user) {
		$courses_id = array();

		if($type_user === "Teacher") {
			$imparts = Impart::getSubjects($person -> dni);

			foreach ($imparts as $impart) {
				$course = Course::findOrFail($impart -> course_id);

				if($course -> school === intval($school) && !in_array($course -> id, $courses_id)) {
					$courses[] = $course;
					$courses_id[] = $course -> id;
				}
			}
		} else {
			$courses = Course::getCourses($school);
		}

		return $courses;
	}

	public function insert(Request $request) {
		$alerts = array();

		$request -> validate([
			'date' => 'required|string',
			'matter' => 'required|string',
			'sender' => 'required|string'
		]);

		if(isset($request -> school) && isset($request -> sender)) {
			$course = Course::findOrFail($request -> course);
			$person = Person::findOrFail($request -> sender);

			if($course -> school === intval($request -> school)) {
				$students = Student::getGroup($request -> course, $request -> group);

				if($request -> massive === false) {
					$student_request = Student::findOrFail($request -> student);

					foreach ($students as $student) {
						if($student -> id === $student_request -> id) {
							$receiver = $student -> legal_guardian;
							$alerts[] = $this -> createAlert($request -> date, $request -> matter, $person, $receiver);
						}
					}
				} else {
					foreach ($students as $student) {
						$receiver = $student -> legal_guardian;
						$alerts[] = $this -> createAlert($request -> date, $request -> matter, $person, $receiver);
					}
				}

				return response() -> json($alerts, 200);
			}
		}
	}

	private function createAlert($date, $matter, $person, $receiver) {
		$alert = new Alert([
			'send_date' => $date,
			'read_date' => "13/12/1986 00:02:15",
			'matter' => $matter,
			'sender' => $person -> dni,
			'receiver' => $receiver,
			'read' => false
		]);

		$alert -> save();

		return $alert;
	}

	public function delete(Request $request) {
		$alert = Alert::findOrFail($request -> id);

		$alert -> delete();

		return response() -> json(200);
	}

	public function checkAlerts(Request $request) {
		$readAlerts = 0;
		$person = Person::findOrFail($request -> sender);
		$alerts = Alert::getSender($person -> dni);

		foreach ($alerts as $alerts) {
			if ($alerts -> read == 1) {
				$readAlerts ++;
			}
		}

		return response() -> json(["readAlerts" => $readAlerts], 200);
	}
}
