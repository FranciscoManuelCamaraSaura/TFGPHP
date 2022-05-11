<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpartTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('impart', function (Blueprint $table) {
			$table -> increments('id');
			$table -> integer('course_id');
			$table -> string('group_words', 1);
			$table -> string('subject');
			$table -> string('teacher');

			$table -> unique(array('course_id', 'group_words', 'subject'));

			$table -> foreign(array('course_id', 'group_words'))
				-> references(array('course_id', 'group_words'))
				-> on('group')
				-> onDelete('cascade');

			$table -> foreign('subject')
				-> references('code')
				-> on('subject')
				-> onDelete('cascade');

			$table -> foreign('teacher')
				-> references('person')
				-> on('teacher')
				-> onDelete('cascade');

			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('impart');
	}
}
