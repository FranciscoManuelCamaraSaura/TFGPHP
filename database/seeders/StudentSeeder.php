<?php

namespace Database\Seeders;

use App\Models\LegalGuardian;
use App\Models\Person;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table('student') -> delete();

		$legalGuardians = LegalGuardian::get();

		$legalGuardian = $legalGuardians[0];
		$person = Person::getDNIPerson($legalGuardian -> person);

		$student = new Student([
			'legal_guardian' => $person -> dni,
			'course_id' => 1,
			'group_words' => "A",
			'name' => 'StudentName1',
			'surnames' => 'Preschool',
			'phone' => $person -> phone,
			'birthday' => '01/01/2017 00:00:00'
		]);

		$student -> save();

		$legalGuardian = $legalGuardians[1];
		$person = Person::getDNIPerson($legalGuardian -> person);

		$student = new Student([
			'legal_guardian' => $person -> dni,
			'course_id' => 4,
			'group_words' => "A",
			'name' => 'StudentName2',
			'surnames' => 'Primary',
			'phone' => $person -> phone,
			'birthday' => '01/01/2014 00:00:00'
		]);

		$student -> save();

		$legalGuardian = $legalGuardians[2];
		$person = Person::getDNIPerson($legalGuardian -> person);

		$student = new Student([
			'legal_guardian' => $person -> dni,
			'course_id' => 12,
			'group_words' => "C",
			'name' => 'StudentName3',
			'surnames' => 'Secundary',
			'phone' => $person -> phone,
			'birthday' => '01/01/2005 00:00:00'
		]);

		$student -> save();

		$legalGuardian = $legalGuardians[3];
		$person = Person::getDNIPerson($legalGuardian -> person);

		$student = new Student([
			'legal_guardian' => $person -> dni,
			'course_id' => 14,
			'group_words' => "B",
			'name' => 'StudentName4',
			'surnames' => 'Bachelor',
			'phone' => $person -> phone,
			'birthday' => '01/01/2004 00:00:00'
		]);

		$student -> save();
	}
}
