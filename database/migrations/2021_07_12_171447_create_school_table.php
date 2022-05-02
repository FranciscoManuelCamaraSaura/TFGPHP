<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('school', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('name');
			$table -> string('address');
			$table -> string('location');
			$table -> string('province');
			$table -> string('phone');
			$table -> string('postal_code');
			$table -> string('web_site');

			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('school');
	}
}
