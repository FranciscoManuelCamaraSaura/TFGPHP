<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('event', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('name');
			$table -> string('description');
			$table -> integer('duration');
			$table -> string('date');
			$table -> integer('school');
			$table -> integer('responsable');

			$table -> foreign('school')
				-> references('id')
				-> on('school')
				-> onDelete('cascade');

			$table -> foreign('responsable')
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
		Schema::dropIfExists('event');
	}
}
