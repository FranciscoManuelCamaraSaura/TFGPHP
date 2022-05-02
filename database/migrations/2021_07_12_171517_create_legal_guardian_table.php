<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalGuardianTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('legal_guardian', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('person', 9);
			$table -> string('user_name');
			$table -> string('password');

			$table -> unique('person');

			$table -> foreign('person')
				-> references('dni')
				-> on('person')
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
		Schema::dropIfExists('legal_guardian');
	}
}
