<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
	use HasFactory;

	protected $table = 'student';
	protected $guarded = 'id';

	protected $fillable = [
		'legal_guardian',
		'course_id',
		'group_words',
		'name',
		'surnames',
		'phone',
		'birthday'
	];

	public $timestamps = false;

	public function legalGuardian() {
		return $this -> belongsTo('App\Models\LegalGuardian');
	}

	public function group() {
		return $this -> belongsTo('App\Models\Group', ['course_id', 'group_words']);
	}

	public Static function getLegalGuaridan($legal_guardian) {
		return Student::where('legal_guardian', '=', $legal_guardian) -> get();
	}

	public static function getGroup($course_id, $group_words) {
		return Student::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> get();
	}

	protected static function newFactory(): StudentFactory {
		return StudentFactory::new();
	}
}
