<?php

namespace Database\Seeders;

use App\Models\LegalGuardian;
use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegalGuardianSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table('legal_guardian') -> delete();

		$legalGuardian = LegalGuardian::factory() -> make();
		$person = Person::getDNIPerson($legalGuardian -> person);

		$legalGuardian -> user_name = $legalGuardian -> person;
		$person -> name = "Legal guardian preschool";

		$person -> save();
		$legalGuardian -> save();

		$legalGuardian = LegalGuardian::factory() -> make();
		$person = Person::getDNIPerson($legalGuardian -> person);

		$legalGuardian -> user_name = $legalGuardian -> person;
		$person -> name = "Legal guardian primary";

		$person -> save();
		$legalGuardian -> save();

		$legalGuardian = LegalGuardian::factory() -> make();
		$person = Person::getDNIPerson($legalGuardian -> person);

		$legalGuardian -> user_name = $legalGuardian -> person;
		$person -> name = "Legal guardian secundary";

		$person -> save();
		$legalGuardian -> save();

		$legalGuardian = LegalGuardian::factory() -> make();
		$person = Person::getDNIPerson($legalGuardian -> person);

		$legalGuardian -> user_name = $legalGuardian -> person;
		$person -> name = "Legal guardian bachelor";

		$person -> save();
		$legalGuardian -> save();
	}
}
