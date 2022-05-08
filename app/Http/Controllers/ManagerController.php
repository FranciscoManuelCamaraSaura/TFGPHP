<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Person;
use App\Models\School;
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

	public function showWeb(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$persons = array();

			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$managers = Manager::getManagerBySchool($school);

			foreach($managers as $manager) {
				$manager_data["id"] = Person::getDNIPerson($manager -> person) -> id;
				$manager_data["name"] = Person::getDNIPerson($manager -> person) -> name;
				$manager_data["surnames"] = Person::getDNIPerson($manager -> person) -> surnames;
				$manager_data["type_admin"] = $this -> getManagerType($manager -> type_admin);

				$persons[] = $manager_data;
			}

			$type_user = $request -> type_user;

			return view("managers_admin", compact("school", "person", "persons", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function validateType(Request $request) {
		$school = $request -> school;
		$managers = Manager::getManagerBySchool($school);

		$counts = $this -> countManagerType($managers, $request -> type_admin);

		if($request -> type_admin === "director" && $counts[0] < 1) {
			return response() -> json(["message" => ""], 200);
		} else if($request -> type_admin === "subdirector" && $counts[1] < 1) {
			return response() -> json(["message" => ""], 200);
		} else if($request -> type_admin === "administrative" && $counts[2] < 3) {
			return response() -> json(["message" => ""], 200);
		} else if($request -> type_admin === "psychopedagogue" && $counts[3] < 4) {
			return response() -> json(["message" => ""], 200);
		} else {
			return response() -> json(["message" => "The school has the maximum number of directors of this type"], 200);
		}
	}

	private function countManagerType($managers, $type_admin) {
		$director = 0;
		$subdirector = 0;
		$administrative = 0;
		$psychopedagogue = 0;

		foreach($managers as $manager) {
			if($manager -> type_admin === $type_admin) {
				switch($manager -> type_admin) {
					case "director":
						$director ++;
		
						break;
		
					case "subdirector":
						$subdirector ++;
		
						break;
		
					case "administrative":
						$administrative ++;
		
						break;
		
					case "psychopedagogue":
						$psychopedagogue ++;
		
						break;
				}
			}
		}

		$counts = [$director, $subdirector, $administrative, $psychopedagogue];

		return $counts;
	}

	public function newManager(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$managers = array();
			$positions = ['director', 'subdirector', 'administrative', 'psychopedagogue'];

			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			foreach($positions as $position) {
				$manager["type"] = $position;
				$manager["description"] = $this -> getManagerType($position);

				$managers[] = $manager;
			}

			return view("new_manager", compact("school", "person", "managers", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	public function editManager(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$managers = array();
			$positions = ['director', 'subdirector', 'administrative', 'psychopedagogue'];

			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			$manager = Person::findOrFail($request -> manager);
			$type_admin["type"] = Manager::getDNIPerson($manager -> dni) -> type_admin;
			$type_admin["description"] = $this -> getManagerType($type_admin["type"]);

			foreach($positions as $position) {
				$manager_type["type"] = $position;
				$manager_type["description"] = $this -> getManagerType($position);

				$managers[] = $manager_type;
			}

			return view("edit_manager", compact("school", "person", "manager", "type_admin", "managers", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid person"], 400);
		}
	}

	private function getManagerType($type_admin) {
		$type_admin_conversion = "";

		switch($type_admin) {
			case "director":
				$type_admin_conversion = "Director";

				break;

			case "subdirector":
				$type_admin_conversion = "Subdirector";

				break;

			case "administrative":
				$type_admin_conversion = "Administrador";

				break;

			case "psychopedagogue":
				$type_admin_conversion = "Psicopedagogo";

				break;
		}

		return $type_admin_conversion;
	}

	public function insert(Request $request) {
		$request -> validate([
			"manager" => "required|string",
		]);

		$manager = new Manager([
			'school' => $request -> school,
			'person' => $request -> manager,
			'user_name' => $request -> manager,
			'password' => "1234",
			'type_admin' => $request -> type_admin
		]);

		$manager -> save();

		return response() -> json($manager, 200);
	}

	public function update(Request $request) {
		if(isset($request -> person)) {
			$person = Person::findOrFail($request -> person);
			$manager = Manager::getDNIPerson($person -> dni);

			if($manager -> password === $request -> oldPassword) {
				$manager -> password = $request -> input('newPassword');

				$manager -> save();

				return response() -> json($manager, 200);
			} else {
				return response() -> json(["message" => "The new password must be different"], 200);
			}
		} else {
			$person = Person::findOrFail($request -> manager);
			$manager = Manager::getDNIPerson($person -> dni);

			$manager -> type_admin = $request -> input("type_admin");

			$manager -> save();

			return response() -> json($manager, 200);
		}
	}

	public function delete(Request $request) {
		$person = Person::findOrFail($request -> manager);
		$manager = Manager::getDNIPerson($person -> dni);

		$manager -> delete();
		$person -> delete();

		return response() -> json(200);
	}
}
