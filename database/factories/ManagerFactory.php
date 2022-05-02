<?php

namespace Database\Factories;

use App\Models\Manager;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManagerFactory extends Factory {
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Manager::class;

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
			'user_name' => $person -> dni,
			'password' => '1234'
		];
	}
}
