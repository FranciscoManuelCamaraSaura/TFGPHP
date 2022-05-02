<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('teacher', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('person');
			$table -> string('user_name');
			$table -> string('password');
			$table -> boolean('preceptor') -> default(false);

			$table -> unique('person');

			$table -> foreign('person')
				-> references('dni')
				-> on('person')
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
		Schema::dropIfExists('teacher');
	}
}
