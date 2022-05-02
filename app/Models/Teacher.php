<?php

namespace App\Models;

use Database\Factories\TeacherFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model {
	use HasFactory;
	
	protected $table = 'teacher';

	protected $fillable = [
		'person',
		'user_name',
		'password',
		'preceptor'
	];

	protected $hidden = [
		'user_name',
		'password'
	];

	protected $casts = [
		'preceptor' => 'boolean'
	];

	public $timestamps = false;

	public function person() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public static function getDNIPerson($person) {
		return Teacher::where('person', '=', $person) -> first();
	}

	public static function getTeacherLogin($user_name, $password) {
		return Teacher::where('user_name', '=', $user_name) -> where('password', '=', $password) -> first();
	}

	public static function getTeacherByUserName($user_name) {
		return Teacher::where('user_name', '=', $user_name) -> first();
	}

	public function isPreceptor() {
		return $this -> belongsTo('App\Models\GroupHavePreceptor', 'teacher');
	}

	public static function getPreceptor() {
		return Teacher::where('preceptor', '=', 1) -> first();
	}

	protected static function newFactory(): TeacherFactory {
		return TeacherFactory::new();
	}
}
