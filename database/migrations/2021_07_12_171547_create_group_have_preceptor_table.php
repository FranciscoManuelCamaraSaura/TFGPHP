<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupHavePreceptorTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('group_have_preceptor', function (Blueprint $table) {
			$table -> integer('course_id');
			$table -> string('group_words', 1);
			$table -> string('preceptor');

			$table -> primary(array('course_id', 'group_words', 'preceptor'));

			$table -> foreign(array('course_id', 'group_words'))
				-> references(array('course_id', 'group_words'))
				-> on('group')
				-> onDelete('cascade');

			$table -> foreign('preceptor')
				-> references('person')
				-> on('teacher')
				-> onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('group_have_preceptor');
	}
}
