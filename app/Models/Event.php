<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
	use HasFactory;

	protected $table = 'event';
	protected $guarded = 'id';

	protected $fillable = [
		'school',
		'date',
		'responsable',
		'name',
		'description',
		'duration'
	];

	public $timestamps = false;

	public function school() {
		return $this -> hasOne('App\Models\School', 'id');
	}

	public function person() {
		return $this -> hasOne('App\Models\Person', 'dni');
	}

	public static function getEventBySchoolResponsable($school, $responsable) {
		return Event::where("school", $school) -> where('responsable', '=', $responsable) -> get();
	}

	protected static function newFactory(): EventFactory {
		return EventFactory::new();
	}
}
