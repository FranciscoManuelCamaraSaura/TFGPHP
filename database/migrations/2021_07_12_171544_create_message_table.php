<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('message', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('date');
			$table -> string('matter');
			$table -> string('text');
			$table -> string('sender') ;
			$table -> string('receiver');
			$table -> integer('previous_message') -> unsigned() -> nullable();
			$table -> boolean('read') -> default(false);
			$table -> boolean('reply') -> default(false);

			$table -> foreign('sender')
				-> references('dni')
				-> on('person')
				-> onDelete('cascade');

			$table -> foreign('receiver')
				-> references('dni')
				-> on('person')
				-> onDelete('cascade');

			$table -> foreign('previous_message')
				-> references('id')
				-> on('message')
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
		Schema::dropIfExists('message');
	}
}
