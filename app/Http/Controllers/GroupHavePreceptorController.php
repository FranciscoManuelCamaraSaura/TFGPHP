<?php

namespace App\Http\Controllers;

use App\Models\GroupHavePreceptor;
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

		return response() -> json($groupHavePreceptor, 200);
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
}
