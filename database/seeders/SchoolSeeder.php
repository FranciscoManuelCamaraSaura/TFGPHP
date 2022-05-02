<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table('school') -> delete();

		$provices = ['Alicante', 'Murcia'];
		$locationAlicante = ['Alicante', 'Elche', 'Orihuela', 'Torrevieja', 'San Vicente'];
		$locationMurcia = ['Murcia', 'Cartagena', 'Beniel', 'Santomera', 'San Javier'];
		$postalCodeAlicante = ['03001', '03201', '03300', '03181', '03009'];
		$postalCodeMurcia = ['30001', '30201', '30130', '30140', '30720'];
		$schoolAlicante = ['School of Alicante', 'School of Elche', 'School of Orihuela', 'School of Torrevieja', 'School of San Vicente'];
		$schoolMurcia = ['School of Murcia', 'School of Cartagena', 'School of Beniel', 'School of Santomera', 'School of San Javier'];

		// alicante's schools
		for($i = 0; $i < count($locationAlicante); ++$i) {
			$school = new School([
				'name' => $schoolAlicante[$i],
				'address' => 'School Street',
				'province' => $provices[0],
				'location' => $locationAlicante[$i],
				'phone' => '123456789',
				'postal_code' => $postalCodeAlicante[$i],
				'web_site' => 'www.school.com'
			]);

			$school -> save();

			$this -> makeManagers($school, $i);
		}

		// murcia's schools
		for($i = 0; $i < count($locationMurcia); ++$i) {
			$school = new School([
				'name' => $schoolMurcia[$i],
				'address' => 'School Street',
				'province' => $provices[1],
				'location' => $locationMurcia[$i],
				'phone' => '123456789',
				'postal_code' => $postalCodeMurcia[$i],
				'web_site' => 'www.school.com'
			]);

			$school -> save();

			$iterator = $i + 5;

			$this -> makeManagers($school, $iterator);
		}
	}

	private function makeManagers($school, $iterator) {
		if($iterator < 2) {
			Manager::factory() -> create([
				'school' => $school -> id,
				'type_admin' => 'director',
			]);

			Manager::factory() -> create([
				'school' => $school -> id,
				'type_admin' => 'subdirector'
			]);

			Manager::factory() -> create([
				'school' => $school -> id,
				'type_admin' => 'administrative'
			]);

			Manager::factory() -> count(2) -> create([
				'school' => $school -> id,
				'type_admin' => 'psychopedagogue'
			]);
		} else {
			Manager::factory() -> create([
				'school' => $school -> id,
				'type_admin' => 'administrative'
			]);
		}
	}
}
