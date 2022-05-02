<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('exam', function (Blueprint $table) {
			$table -> increments('id');
			$table -> integer('course_id');
			$table -> string('group_words', 1);
			$table -> integer('event');
			$table -> string('subject');
			$table -> enum('type_exam', array('written', 'oral', 'presentation', 'exhibition', 'optional_work', 'homework'));
			$table -> enum('evaluation', array('first_trimester', 'second_trimester', 'third_trimester'));

			$table -> unique(array('course_id', 'group_words', 'event', 'subject'));

			$table -> foreign(array('course_id', 'group_words'))
				-> references(array('course_id', 'group_words'))
				-> on('group')
				-> onDelete('cascade');

			$table -> foreign('event')
				-> references('id')
				-> on('event')
				-> onDelete('cascade');

			$table -> foreign('subject')
				-> references('code')
				-> on('subject')
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
		Schema::dropIfExists('exam');
	}
}
