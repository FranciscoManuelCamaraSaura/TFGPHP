<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$this -> call(SchoolSeeder::class);
		$this -> call(CourseSeeder::class);
		$this -> call(GroupSeeder::class);
		// $this -> call(PersonSeeder::class);
		// $this -> call(LegalGuardianSeeder::class);
		// $this -> call(StudentSeeder::class);
		// $this -> call(ManagerSeeder::class);
		$this -> call(SubjectSeeder::class);
		$this -> call(TeacherSeeder::class);
		$this -> call(ImpartSeeder::class);
		$this -> call(GroupHavePreceptorSeeder::class);
		$this -> call(MessageSeeder::class);
		$this -> call(EventSeeder::class);
		$this -> call(ExamSeeder::class);
		$this -> call(MakesSeeder::class);
		// $this -> call(User::class);
	}
}
