<?php

namespace App\Models;

use Database\Factories\ManagerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model {
	use HasFactory;
	
	protected $table = 'manager';
	protected $guarded = 'id';

	protected $fillable = [
		'person',
		'school',
		'user_name',
		'password',
		'type_admin'
	];

	protected $hidden = [
		'user_name',
		'password'
	];

	public $timestamps = false;

	public function person() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public function school() {
		return $this -> hasOne('App\Models\School', 'id');
	}

	public static function getDNIPerson($person) {
		return Manager::where('person', '=', $person) -> first();
	}

	public static function getManagerBySchool($school_id) {
		return Manager::where('school', '=', $school_id) -> get();
	}

	public static function getManagerLogin($user_name, $password) {
		return Manager::where('user_name', '=', $user_name) -> where('password', '=', $password) -> first();
	}

	public static function getManagerByUserName($user_name) {
		return Manager::where('user_name', '=', $user_name) -> first();
	}

	protected static function newFactory(): ManagerFactory {
		return ManagerFactory::new();
	}
}
