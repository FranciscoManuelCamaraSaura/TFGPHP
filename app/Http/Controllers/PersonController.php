<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller {
	public function show(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		// $output->writeln($request);
		$person = Person::getDNIPerson($request -> dni);

		return response()->json($person, 200);
	}

	public function profile(Request $request) {
		if (isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			return view("profile", compact("school", "person", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function insert(Request $request) {
		$request -> validate([
			"dni" => "required|string",
			"name" => "required|string",
			"surnames" => "required|string",
			"address" => "required|string",
			"location" => "required|string",
			"province" => "required|string",
			"phone" => "required|integer",
			"email" => "required|email",
			"postal_code" => "required|string"
		]);

		$person = Person::getDNIPerson($request -> dni);

		if(!isset($person)) {
			$person = new Person([
				'dni' => $request -> dni,
				'name' => $request -> name,
				'surnames' => $request -> surnames,
				'address' => $request -> address,
				'location' => $request -> location,
				'province' => $request -> province,
				'phone' => $request -> phone,
				'email' => $request -> email,
				'postal_code' => $request -> postal_code
			]);

			$person -> save();
	
			return response() -> json($person, 200);
		} else {
			return response() -> json(["message" => "The identifier already exists"], 400);
		}
	}

	public function update(Request $request) {
		if (isset($request -> id)) {
			$person = Person::getDNIPerson($request -> dni);
		} else if (isset($request -> person)) {
			$person = Person::findOrFail($request -> person);
		} else if (isset($request -> dni)) {
			$person = Person::getDNIPerson($request -> dni);
		}

		if (!isset($request -> type_user)) {
			$request -> validate([
				"address" => "required|string",
				"location" => "required|string",
				"province" => "required|string",
				"phone" => "required|integer",
				"email" => "required|email"
			]);

			$person -> address = $request -> input("address");
			$person -> location = $request -> input("location");
			$person -> province = $request -> input("province");
			$person -> phone = $request -> input("phone");
			$person -> email = $request -> input("email");

			$person -> save();
	
			return response() -> json($person, 200);
		} else if ($request -> type_user === "Admin") {
			$updatePerson = Person::getDNIPerson($request -> dni);

			if(!isset($updatePerson)) {
				$request -> validate([
					"dni" => "required|string",
					"name" => "required|string",
					"surnames" => "required|string",
					"address" => "required|string",
					"location" => "required|string",
					"province" => "required|string",
					"phone" => "required|integer",
					"email" => "required|email",
					"postal_code" => "required|string"
				]);

				$person -> dni = $request -> input("dni");
				$person -> name = $request -> input("name");
				$person -> surnames = $request -> input("surnames");
				$person -> address = $request -> input("address");
				$person -> location = $request -> input("location");
				$person -> province = $request -> input("province");
				$person -> phone = $request -> input("phone");
				$person -> email = $request -> input("email");
				$person -> postal_code = $request -> input("postal_code");

				$person -> save();
		
				return response() -> json($person, 200);
			} else {
				return response() -> json(["message" => "The identifier already exists"], 400);
			}
		}
	}
}
