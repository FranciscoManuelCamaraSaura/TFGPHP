<?php

namespace App\Models;

use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model {
	use HasFactory;

	protected $table = 'person';
	protected $guarded = 'id';

	protected $fillable = [
		'dni',
		'name',
		'surnames',
		'address',
		'location',
		'province',
		'phone',
		'email',
		'postal_code'
	];

	protected $hidden = [
		'remember_token'
	];

	public $timestamps = false;

	public function legalGuardian() {
		return $this -> belongsTo('App\Models\LegalGuardian', 'person', 'dni');
	}

	public function teacher() {
		return $this -> belongsTo('App\Models\Teacher', 'person', 'dni');
	}

	public function manager() {
		return $this -> belongsTo('App\Models\Manager', 'person', 'dni');
	}

	public static function getDNIPerson($dni) {
		return Person::where('dni', '=', $dni) -> first();
	}

	public static function getTeacherByName($name) {
		return Person::where('name', 'LIKE', '%' . $name . '%') -> first();
	}

	public static function getTeacherByNameSurname($name, $surnames) {
		return Person::where('name', 'LIKE', '%' . $name) -> where('surnames', '=', $surnames) -> first();
	}

	protected static function newFactory(): PersonFactory {
		return PersonFactory::new();
	}
}
