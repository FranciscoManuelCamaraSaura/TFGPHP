<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('alert', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('send_date');
			$table -> string('read_date');
			$table -> string('matter');
			$table -> string('sender') ;
			$table -> string('receiver');
			$table -> boolean('read') -> default(false);

			$table -> foreign('sender')
				-> references('dni')
				-> on('person')
				-> onDelete('cascade');

			$table -> foreign('receiver')
				-> references('dni')
				-> on('person')
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
		Schema::dropIfExists('alert');
	}
}
