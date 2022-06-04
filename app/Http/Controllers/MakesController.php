<?php

namespace App\Http\Controllers;

use App\Models\Makes;
use Illuminate\Http\Request;

class MakesController extends Controller {
	public function show(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		$note = Makes::getNote($request -> student);

		return response() -> json($note, 200);
	}
}
