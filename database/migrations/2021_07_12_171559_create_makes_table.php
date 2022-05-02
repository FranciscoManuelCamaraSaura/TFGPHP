<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('makes', function (Blueprint $table) {
			$table -> increments('id');
			$table -> integer('student');
			$table -> integer('exam');
			$table -> float('note', 4, 2) -> default(0.00);

			$table -> unique(array('student', 'exam'));

			$table -> foreign('student')
				-> references('id')
				-> on('student')
				-> onDelete('cascade');

			$table -> foreign('exam')
				-> references('id')
				-> on('exam')
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
		Schema::dropIfExists('makes');
	}
}
