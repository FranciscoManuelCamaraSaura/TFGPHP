<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Person::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition() {
		// DNI
		$dni = "";
		$dniRandom = 0;

		for ($i = 0; $i < 8; $i++) {
			$dni .= intval(random_int(0, 9));
			$dniRandom += random_int(0, 9);
		}

		$posicion = intval($dniRandom % 23);
		$letras = "TRWAGMYFPDXBNJZSQVHLCKEO";
		$dni .= substr($letras, $posicion, 1);

		// Provinces
		$provices = ['Alicante', 'Murcia'];

		// Postal code
		$postalCode = "03" . intval(random_int(0, 9)) . "0" . intval(random_int(0, 9));

		return [
			'dni' => $dni,
			'name' =>  $this -> faker -> name(),
			'surnames' => $this -> faker -> lastName(),
			'address' => $this -> faker -> streetAddress(),
			'location' => $this -> faker -> city(),
			'province' => $provices[array_rand($provices, 1)],
			'phone' => '123456789',
			'email' => $this -> faker -> safeEmail(),
			'postal_code' => $postalCode,
		];
	}
}
