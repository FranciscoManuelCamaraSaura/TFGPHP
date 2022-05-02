<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Impart;
use App\Models\Message;
use App\Models\Person;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class MessageController extends Controller {
	public function showSenderWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);

		$persons_names = array();
		$persons = array();

		if(isset($request -> id) && isset($request -> sender)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> sender);
			$messages = Message::getSender($person -> dni);
			$type_user = $request -> type_user;

			foreach ($messages as $message) {
				if (!in_array($message -> receiver, $persons_names)) {
					$receiver = Person::getDNIPerson($message -> receiver);
					$persons_names[] = $receiver -> dni;
				}
			}

			foreach ($persons_names as $receiver) {
				$persons[] = Person::getDNIPerson($receiver);
			}

			$send = true;

			return view("messages", compact("school", "person", "messages", "persons", "type_user", "send"));
		}
	}

	public function showSenderApi(Request $request) {
		$messagesSent = Message::getSender($request -> sender);

		return response() -> json($messagesSent, 200);
	}

	public function showReceiverWeb(Request $request) {
		$persons_names = array();
		$persons = array();

		if(isset($request -> id) && isset($request -> receiver)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> receiver);
			$messages = Message::getReceiver($person -> dni);
			$type_user = $request -> type_user;

			foreach ($messages as $message) {
				if (!in_array($message -> sender, $persons_names)) {
					$sender = Person::getDNIPerson($message -> sender);
					$persons_names[] = $sender -> dni;
				}
			}

			foreach ($persons_names as $sender) {
				$persons[] = Person::getDNIPerson($sender);
			}

			$send = false;

			return view("messages", compact("school", "person", "messages", "persons", "type_user", "send"));
		}
	}

	public function showReceiverApi(Request $request) {
		$messagesReceived = Message::getReceiver($request -> receiver);

		return response() -> json($messagesReceived, 200);
	}

	public function checkNewMessages(Request $request) {
		$noReadedMessages = 0;
		$person = Person::findOrFail($request -> receiver);
		$messages = Message::getReceiver($person -> dni);

		foreach ($messages as $message) {
			if ($message -> read == 0) {
				$noReadedMessages ++;
			}
		}

		return response() -> json(["noReadedMessages" => $noReadedMessages], 200);
	}

	public function insertSenderWeb(Request $request) {
		$request -> validate([
			'date' => 'required|string',
			'matter' => 'required|string',
			'text' => 'required|string',
			'sender' => 'required|string',
			'receiver' => 'required|string',
		]);

		$sender = Person::getDNIPerson($request -> sender);
		$receiver = Person::getDNIPerson($request -> receiver);

		if($sender != null & $receiver != null) {
			$message = new Message([
				'date' => $request -> date,
				'matter' => $request -> matter,
				'text' => $request -> text,
				'sender' => $request -> sender,
				'receiver' => $request -> receiver,
				'read' => false,
				'reply' => false
			]);

			if($request -> previous_message != 0) {
				$message -> previous_message = $request -> previous_message;

				$previous_message = Message::find($message -> previous_message);

				$previous_message -> reply = true;

				$previous_message -> save();
			}

			$message -> save();

			return response() -> json($message, 200);
		}

		return response() -> json(['type' => 'receiver', 'message' => 'Invalid receiver'], 400);
	}

	public function insertSenderApi(Request $request) {
		$request -> validate([
			'date' => 'required|string',
			'matter' => 'required|string',
			'text' => 'required|string',
			'sender' => 'required|string',
			'receiver' => 'required|string',
		]);

		$student = Student::getLegalGuaridan($request -> sender);
		$teachers = Impart::getTeachers($student[0] -> course_id, $student[0] -> group_words);

		foreach($teachers as $teacher) {
			if($request -> receiver === $teacher) {
				$message = new Message([
					'date' => $request -> date,
					'matter' => $request -> matter,
					'text' => $request -> text,
					'sender' => $request -> sender,
					'receiver' => $request -> receiver,
					'read' => false,
					'reply' => false
				]);

				if($request -> previous_message != 0) {
					$message -> previous_message = $request -> previous_message;

					$previous_message = Message::find($message -> previous_message);

					$previous_message -> reply = true;

					$previous_message -> save();
				}

				$message -> save();

				return response() -> json($message, 200);
			}
		}

		return response() -> json(['type' => 'receiver', 'message' => 'Invalid receiver'], 400);
	}

	/*public function insertReceiverApi(Request $request) {
		$request -> validate([
			'date' => 'required|string',
			'matter' => 'required|string',
			'text' => 'required|string',
			'sender' => 'required|string',
			'receiver' => 'required|string',
		]);

		$student = Student::getLegalGuaridan($request -> receiver);
		$teachers = Impart::getTeachers($student[0] -> course_id, $student[0] -> group_words);

		foreach($teachers as $teacher) {
			if($request -> sender === $teacher) {
				$message = new Message([
					'date' => $request -> date,
					'matter' => $request -> matter,
					'text' => $request -> text,
					'sender' => $request -> sender,
					'receiver' => $request -> receiver,
					'read' => false,
					'reply' => false
				]);

				if($request -> previous_message != 0) {
					$message -> previous_message = $request -> previous_message;

					$previous_message = Message::find($message -> previous_message);

					$previous_message -> reply = true;

					$previous_message -> save();
				}

				$message -> save();

				return response() -> json($message, 200);
			}
		}

		return response() -> json(['type' => 'receiver', 'message' => 'Invalid receiver'], 400);
	}*/

	public function updateRead(Request $request) {
		$message = Message::find($request -> id);

		$message -> read = true;

		$message -> save();

		return response() -> json(200);
	}

	public function updateReply(Request $request) {
		$message = Message::find($request -> id);

		$message -> reply = true;

		$message -> save();

		return response() -> json(200);
	}

	public function updateData(Request $request) {
		$message = Message::find($request -> id);

		return response() -> json($message, 200);
	}

	public function messages(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			return view("messages_menu", compact("school", "person", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function newMessage(Request $request) {
		$groups = array();
		$subjects = array();

		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;
			$pantalla = $request -> pantalla;

			$courses = $this -> getCourses($school, $person, $type_user);

			if (isset($request -> previous_message)) {
				$previous_message = $request -> previous_message;
				$message = Message::findOrFail($previous_message);
				$students = Student::getLegalGuaridan($message -> sender);
				$student = $students[0];

				if($type_user === "Teacher") {
					$subject_default = Impart::getSubject($student -> course_id, $student -> group_words, $message -> receiver);
					$subjects[] = Subject::getSubjectByCode($subject_default[0] -> subject);
				} else {
					$subject_default = Impart::getByCourseGroup($student -> course_id, $student -> group_words);
				}

				$course_default = $student -> course_id;
				$groups = Group::getGroups($student -> course_id);
				$group_default = $student -> group_words;
			} else if (isset($request -> subject)) {
				$previous_message = 0;
				$student = Student::findOrFail($request -> student);
				$subject_default = Subject::getSubjectByCode($request -> subject);
				$subjects[] = $subject_default;
				$course_default = $student -> course_id;
				$groups = Group::getGroups($student -> course_id);
				$group_default = $student -> group_words;
			} else if (isset($request -> student)) {
				$previous_message = 0;
				$student = Student::findOrFail($request -> student);
				$imparts = Impart::getSubject($student -> course_id, $student -> group_words, $person -> dni);

				foreach($imparts as $impart) {
					$subjects[] = Subject::getSubjectByCode($impart -> subject);
				}

				$subject_default = $subjects[0];
				$course_default = $student -> course_id;
				$groups = Group::getGroups($student -> course_id);
				$group_default = $student -> group_words;
			} else {
				$previous_message = 0;
				$student = "";
				$subject_default = "";
				$course_default = "";
				$group_default = "";
			}

			return view("new_message", compact("school", "person", "courses", "groups", "subjects", "previous_message", "course_default", "group_default", "subject_default", "student", "type_user", "pantalla"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function getCourses($school, $person, $type_user) {
		$courses_id = array();

		if($type_user === "Teacher") {
			$imparts = Impart::getSubjects($person -> dni);

			foreach ($imparts as $impart) {
				$course = Course::findOrFail($impart -> course_id);

				if($course -> school === $school && !in_array($course -> id, $courses_id)) {
					$courses[] = $course;
					$courses_id[] = $course -> id;
				}
			}
		} else {
			$courses = Course::getCourses($school);
		}

		return $courses;
	}

	public function students(Request $request) {
		if(isset($request -> course) && isset($request -> group) && isset($request -> subject)) {
			$students = Student::getGroup($request -> course, $request -> group);

			return response() -> json(["students" => $students], 200);
		} else {
			return response() -> json(["message" => "Invalid subject"], 400);
		}
	}

	public function previewMessage(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$subject = Subject::getSubjectByCode($request -> subject);
			$student = Student::findOrFail($request -> student);
			$matter = $request -> matter;
			$message = $request -> message;
			$previous_message = $request -> previous_message;
			$type_user = $request -> type_user;
			$pantalla = $request -> pantalla;

			return view("preview_message", compact("school", "person", "subject", "student", "matter", "message", "previous_message", "type_user", "pantalla"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function getMessage(Request $request) {
		if(isset($request -> id) && isset($request -> person) && isset($request -> message)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$message = Message::findOrFail($request -> message);

			$send = $person -> dni === $message -> sender ? true : false;

			if($send) {
				$sender_receiver = Person::getDNIPerson($message -> sender);
				$student = Student::getLegalGuaridan($message -> receiver);
			} else {
				$sender_receiver = Person::getDNIPerson($message -> receiver);
				$student = Student::getLegalGuaridan($message -> sender);

				if($message -> read == false) {
					$message -> read = true;
			
					$message -> save();
				}
			}

			$type_user = $request -> type_user;
			$student_message = $student[0];

			if($type_user === "Teacher") {
				$impart = Impart::getSubject($student[0] -> course_id, $student[0] -> group_words, $sender_receiver -> dni);
				$subject = Subject::getSubjectByCode($impart[0] -> subject);
			} else {
				$subjects = Impart::getByCourseGroup($student[0] -> course_id, $student[0] -> group_words);
				$subject = $subjects;
			}

			return view("message", compact("school", "person", "message", "sender_receiver", "student_message", "subject", "type_user", "send"));
		} else {
			return response() -> json(["message" => "Invalid message"], 400);
		}
	}
}
