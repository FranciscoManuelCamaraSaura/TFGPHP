<?php

namespace App\Http\Controllers;

use App\Models\GroupHavePreceptor;
use App\Models\Person;
use Illuminate\Http\Request;

class GroupHavePreceptorController extends Controller {
	public function showWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		$groupHavePreceptor = GroupHavePreceptor::getByPreceptor($request -> person);

		return response() -> json($groupHavePreceptor, 200);
	}

	public function show(Request $request) {
		$groupHavePreceptor = GroupHavePreceptor::getByCourseGroup($request -> course, $request -> group);

		if(isset($groupHavePreceptor)) {
			return response() -> json($groupHavePreceptor, 200);
		} else {
			return response() -> json(["message" => "The curse & group does not have a preceptor"], 200);
		}
	}

	public function insert(Request $request) {
		$request -> validate([
			"course" => "required|string",
			"group" => "required|string",
			"preceptor" => "required|string"
		]);

		$preceptor = new GroupHavePreceptor([
			'course_id' => $request -> course,
			'group_words' => $request -> group,
			'preceptor' => $request -> preceptor
		]);

		$preceptor -> save();

		return response() -> json($preceptor, 200);
	}

	public function update(Request $request) {
		$request -> validate([
			"course" => "required|string",
			"group" => "required|string",
			"preceptor" => "required|string"
		]);

		$person = Person::findOrFail($request -> preceptor);
		$preceptor = GroupHavePreceptor::getByPreceptor($person -> dni);

		$preceptor -> delete();

		$preceptor = new GroupHavePreceptor([
			'course_id' => $request -> course,
			'group_words' => $request -> group,
			'preceptor' => $request -> preceptor
		]);

		$preceptor -> save();

		return response() -> json($preceptor, 200);
	}

	public function delete(Request $request) {
		$preceptor = GroupHavePreceptor::getByPreceptor($request -> preceptor);

		$preceptor -> delete();

		return response() -> json($preceptor, 200);
	}
}
