<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('course', function (Blueprint $table) {
			$table -> increments('id');
			$table -> integer('school');
			$table -> enum('degree', array('preschool', 'primary', 'secundary', 'bachelor'));
			$table -> integer('number');

			$table -> unique(array('school', 'degree', 'number'));

			$table -> foreign('school')
				-> references('id') -> on('school')
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
		Schema::dropIfExists('course');
	}
}
