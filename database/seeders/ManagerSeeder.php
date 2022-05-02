<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Manager::factory() -> create([
			'type_admin' => 'director',
		]);

		Manager::factory() -> create([
			'type_admin' => 'subdirector',
		]);

		Manager::factory() -> create([
			'type_admin' => 'administrative',
		]);

		Manager::factory() -> count(2) -> create([
			'type_admin' => 'psychopedagogue',
		]);
	}
}
