<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Makes;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller {
	public function insert(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		$request -> validate([
			'course' => 'required|integer',
			'group' => 'required|string',
			'event' => 'required|integer',
			'subject' => 'required|string',
			'type_exam' => 'required|string',
			'evaluation' => 'required|string'
		]);

		$exam = new Exam([
			'course_id' => $request -> course,
			'group_words' => $request -> group,
			'event' => $request -> event,
			'subject' => $request -> subject,
			'type_exam' => $request -> type_exam,
			'evaluation' => $request -> evaluation
		]);

		$exam -> save();

		return response() -> json($exam, 200);
	}

	public function update(Request $request) {
		$request -> validate([
			'course' => 'required|integer',
			'group' => 'required|string',
			'subject' => 'required|string',
			'type_exam' => 'required|string',
			'evaluation' => 'required|string'
		]);

		$exam = Exam::findOrFail($request -> id);

		$exam -> course_id = $request -> course;
		$exam -> group_words = $request -> group;
		$exam -> subject = $request -> subject;
		$exam -> type_exam = $request -> type_exam;
		$exam -> evaluation = $request -> evaluation;

		$exam -> save();

		return response() -> json($exam, 200);
	}

	public function evaluate(Request $request) {
		if (isset($request -> id) && isset($request -> person) && isset($request -> type_user)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			$exam = Exam::findOrFail($request -> exam);
			$course = Course::findOrFail($exam -> course_id);
			$subject = Subject::getSubjectByCode($exam -> subject);

			if($course -> school === $school) {
				$students = Student::getGroup($exam -> course_id, $exam -> group_words);
			}

			foreach($students as $student) {
				$evaluations[] = $this -> getNoteOfExam($student, $exam -> id);
			}

			return view("evaluation", compact("school", "person", "subject", "evaluations", "exam", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	private function getNoteOfExam($student, $exam) {
		$evaluation = array();

		$evaluation["labelId"] = "label" . $student -> id;
		$evaluation["id"] = $student -> id;
		$evaluation["name"] = $student -> name;
		$evaluation["surnames"] = $student -> surnames;
		$note = Makes::getNote($student -> id, $exam);

		if(isset($note)) {
			$evaluation["note"] = $note -> note;
		} else {
			$evaluation["note"] = 0.00;
		}

		return $evaluation;
	}

	public function makeEvaluation(Request $request) {
		$students = $request -> students;
		$notes = $request -> notes;

		for ($i = 0; $i < count($students); $i++) {
			$exam = Makes::getNote($students[$i], $request -> exam);

			if(isset($exam)) {
				$exam -> student = $students[$i];
				$exam -> exam = $request -> exam;
				$exam -> note = round($notes[$i], 2);
			} else {
				$exam = new Makes([
					'student' => $students[$i],
					'exam' => $request -> exam,
					'note' => round($notes[$i], 2)
				]);
			}

			$exam -> save();
		}

		return response() -> json($exam, 200);
	}

	public function delete(Request $request) {
		$exam = Exam::findOrFail($request -> id);
		$event = Event::findOrFail($exam -> event);

		$exam -> delete();
		$event -> delete();

		return response() -> json(200);
	}
}
