<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Person;
use Illuminate\Http\Request;

class ManagerController extends Controller {
	public function index(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);

		$managers = Manager::getManagerBySchool($request -> school_id);

		return response()->json($managers, 200);
	}

	public function show(Request $request) {
		if (is_string($request -> managers_id)) {
			$managers_id = explode(", ", $request -> managers_id);

			foreach($managers_id as $manager) {
				$managers[] = Person::getDNIPerson($manager);
			}
		} else {
			foreach($request -> managers_id as $manager) {
				$managers[] = Person::getDNIPerson($manager);
			}
		}

		return response()->json($managers, 200);
	}

	public function login(Request $request) {
		if (isset($request -> id)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> manager);
			$manager = Manager::findOrFail($person -> id);

			if($manager -> type_admin !== "administrative") {
				$type_user = "Manager";
			} else {
				$type_user = "Admin";
			}

			return view("home", compact("school", "person", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function update(Request $request) {
		$person = Person::findOrFail($request -> person);
		$manager = Manager::getDNIPerson($person -> dni);

		if($manager -> password !== $request -> oldPassword) {
			$manager -> password = $request -> input('newPassword');

			$manager -> save();

			return response() -> json($manager, 200);
		} else {
			return response() -> json(["message" => "The new password must be different"], 200);
		}
	}
}
