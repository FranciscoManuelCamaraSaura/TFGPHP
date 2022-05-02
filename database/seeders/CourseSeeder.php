<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table('course') -> delete();

		$schools = School::get();

		$it = 0;

		foreach($schools as $school) {
			//Preschool
			for ($i = 1; $i < 3; $i++) {
				$course = new Course([
					'school' => $school -> id,
					'degree' => 'preschool',
					'number' => $i
				]);

				$course -> save();
			}

			//Primary
			for ($i = 1; $i < 7; $i++) {
				$course = new Course([
					'school' => $school -> id,
					'degree' => 'primary',
					'number' => $i
				]);

				$course -> save();
			}

			if ($it < 2) {
				//Secundary
				for ($i = 1; $i < 5; $i++) {
					$course = new Course([
						'school' => $school -> id,
						'degree' => 'secundary',
						'number' => $i
					]);

					$course -> save();
				}

				//Bachelor
				for ($i = 1; $i < 3; $i++) {
					$course = new Course([
						'school' => $school -> id,
						'degree' => 'bachelor',
						'number' => $i
					]);

					$course -> save();
				}
			}

			$it++;
		}
	}
}
