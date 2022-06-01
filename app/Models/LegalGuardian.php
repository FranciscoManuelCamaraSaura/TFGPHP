<?php

namespace App\Models;

use Database\Factories\LegalGuardianFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalGuardian extends Model {
	use HasFactory;

	protected $table = 'legal_guardian';
	protected $guarded = 'id';

	protected $fillable = [
		'person',
		'user_name',
		'password'
	];

	public $timestamps = false;

	public function person() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public function student() {
		return $this -> hasMany('App\Models\Student', 'id');
	}

	public static function getDNIPerson($person) {
		return LegalGuardian::where('person', '=', $person) -> first();
	}

	public static function getLegalGuardianLogin($user_name, $password) {
		return LegalGuardian::where('user_name', '=', $user_name) -> where('password', '=', $password) -> first();
	}

	public static function getLegalGuardianUserName($user_name) {
		return LegalGuardian::where('user_name', '=', $user_name) -> first();
	}

	protected static function newFactory(): LegalGuardianFactory {
		return LegalGuardianFactory::new();
	}
}
