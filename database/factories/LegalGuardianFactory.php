<?php

namespace Database\Factories;

use App\Models\LegalGuardian;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegalGuardianFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = LegalGuardian::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition() {
		$person = Person::factory() -> make();

		$person -> save();

		return [
			'person' => $person -> dni,
			'user_name' => 'user',
			'password' => '1234'
		];
	}
}
