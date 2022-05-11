<?php

namespace App\Http\Controllers;

use App\Models\Impart;
use App\Models\Person;
use Illuminate\Http\Request;

class ImpartController extends Controller {
	public function showWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		// $output->writeln($request);
		$impart = Impart::getTeacherByCourseGroupSubject($request -> course, $request -> group, $request -> subject);

		if(!isset($impart)) {
			return response() -> json(["message" => "The subject does not have a teacher yet"], 200);
		} else {
			if(isset($request -> teacher)) {
				$person = Person::findOrFail($request -> teacher);

				if($impart -> teacher === $person -> dni) {
					return response() -> json(["message" => "The subject does not have a teacher yet"], 200);
				} else {
					return response() -> json(["message" => "The subject already has a teacher"], 200);
				}
			} else {
				return response() -> json(["message" => "The subject already has a teacher"], 200);
			}
		}
	}

	public function showApi(Request $request) {
		$imparts = Impart::getByCourseGroup($request -> course_id, $request -> group_words);

		return response() -> json($imparts, 200);
	}

	public function insert(Request $request) {
		$request -> validate([
			"course" => "required|integer",
			"group" => "required|string",
			"subject" => "required|string",
			"teacher" => "required|string",
		]);

		$impart = new Impart([
			'course_id' => $request -> course,
			'group_words' => $request -> group,
			'subject' => $request -> subject,
			'teacher' => $request -> teacher,
		]);

		$impart -> save();

		return response() -> json($impart, 200);
	}

	public function update(Request $request) {
		
	}

	public function delete(Request $request) {
		$imparts = Impart::getSubjects($request -> teacher);

		foreach($imparts as $impart) {
			$impart -> delete();
		}

		return response() -> json($imparts, 200);
	}
}
