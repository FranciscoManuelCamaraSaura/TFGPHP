<?php

namespace App\Models;

use Database\Factories\SchoolFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model {
	use HasFactory;

	protected $table = 'school';
	protected $guarded = 'id';

	protected $fillable = [
		'name',
		'address',
		'location',
		'province',
		'phone',
		'postal_code',
		'web_site'
	];

	public $timestamps = false;

	public function course() {
		return $this -> belongsTo('App\Models\Course');
	}

	protected static function newFactory(): SchoolFactory {
		return SchoolFactory::new();
	}

	public static function getLocationsByProvince($province) {
		return School::where('province', '=', $province) -> get();
	}

	public static function getSchoolsByLocation($location) {
		return School::where('location', '=', $location) -> get();
	}
}
