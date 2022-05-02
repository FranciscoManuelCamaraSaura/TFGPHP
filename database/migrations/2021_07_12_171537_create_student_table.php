<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('student', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('legal_guardian', 9);
			$table -> integer('course_id');
			$table -> string('group_words', 1);
			$table -> string('name');
			$table -> string('surnames');
			$table -> integer('phone');
			$table -> text('birthday');

			$table -> foreign(array('course_id', 'group_words'))
				-> references(array('course_id', 'group_words'))
				-> on('group')
				-> onDelete('cascade');

			$table -> foreign('legal_guardian')
				-> references('person')
				-> on('legal_guardian')
				-> onDelete('cascade');

			$table -> index(array('course_id', 'group_words'));

			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('student');
	}
}
