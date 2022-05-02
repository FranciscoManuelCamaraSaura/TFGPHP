<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagerTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('manager', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('person');
			$table -> integer('school');
			$table -> string('user_name');
			$table -> string('password');
			$table -> enum('type_admin', array('director', 'subdirector', 'administrative', 'psychopedagogue'));

			$table -> unique('person');

			$table -> foreign('person')
				-> references('dni')
				-> on('person')
				-> onDelete('cascade');

			$table -> foreign('school')
				-> references('id')
				-> on('school')
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
		Schema::dropIfExists('manager');
	}
}
