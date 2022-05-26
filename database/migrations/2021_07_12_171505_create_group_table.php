<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('group', function (Blueprint $table) {
			$table -> increments('id');
			$table -> integer('course_id');
			$table -> string('group_words', 1);

			$table -> primary(array('course_id', 'group_words'));

			$table -> foreign('course_id')
				-> references('id') -> on('course')
				-> onDelete('cascade');

			$table -> timestamps();
		});
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('group');
	}
}
