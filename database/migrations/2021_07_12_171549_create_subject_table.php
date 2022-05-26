<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('subject', function (Blueprint $table) {
			$table -> increments('id');
			$table -> string('code');
			$table -> string('name');
			$table -> string('description');
			$table -> enum('degree', array('preschool', 'primary', 'secundary', 'bachelor'));
			$table -> integer('number') -> unsigned() -> nullable();
			$table -> string('group_words', 1) -> unsigned() -> nullable();
			$table -> enum('type', array('Troncales generales',
										'Troncales de opción',
										'Específicas (secundaria)',
										'Libre configuración autonómica (secundaria)',
										'Específicas 2 (1 Random)',
										'Troncales de opción 2 (1 Random)',
										'Específicas de opción (1 Random)',
										'Libre configuración autonómica de opción (1 Random)',
										'Troncal general de modalidad',
										'Troncal de opción de modalidad',
										'Troncal de opción de modalidad (2 Random)',
										'Específicas (bachiller)',
										'Libre configuración autonómica (bachiller)',
										'Troncales de opción de modalidad (1 Random)',
										'Específicas de opción (2 Random)',
										'Libre configuración autonómica (voluntaria)'));

			$table -> primary('code');

			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('subject');
	}
}
