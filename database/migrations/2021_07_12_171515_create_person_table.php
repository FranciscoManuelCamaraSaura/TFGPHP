<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('person', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('dni', 9);
			$table -> string('name');
			$table -> string('surnames');
			$table -> string('address');
			$table -> string('location');
			$table -> string('province');
			$table -> string('phone');
			$table -> string('email');
			$table -> string('postal_code');
			$table -> rememberToken();

			$table -> unique('dni');

			$table -> timestamps();
		});
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('person');
	}
}
