<?php

namespace App\Http\Controllers;

use App\Models\Impart;
use Illuminate\Http\Request;

class ImpartController extends Controller {
	public function show(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
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
}
