<?php

namespace App\Models;

use Database\Factories\SubjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
	use HasFactory;

	protected $table = 'subject';

	protected $fillable = [
		'code',
		'name',
		'description',
		'degree',
		'type'
	];

	public $timestamps = false;

	public function impart() {
		return $this -> belongsTo('App\Models\Impart');
	}

	public static function getSubjectByCode($code) {
		return Subject::where('code', '=', $code) -> first();
	}

	public static function getSubjectByDegree($degree) {
		return Subject::where('degree', '=', $degree) -> get();
	}

	public static function getSubjectByDegreeCourse($degree, $number) {
		return Subject::where('degree', '=', $degree) -> where('number', '=', $number) -> get();
	}

	public static function getSubjectByDegreeCourseType($degree, $number, $type) {
		return Subject::where('degree', '=', $degree) -> where('number', '=', $number)
			-> where('type', '=', $type) -> get();
	}

	public static function getSubjectByDegreeCourseGroupType($degree, $number, $groupWord, $type) {
		return Subject::where('degree', '=', $degree) -> where('number', '=', $number)
			-> where('group_words', '=', $groupWord) -> where('type', '=', $type) -> get();
	}

	public static function getSubjectByDegreeCourseWord($degree, $number, $groupWord) {
		return Subject::where('degree', '=', $degree) -> where('number', '=', $number)
			-> where('group_words', '=', $groupWord) -> get();
	}

	protected static function newFactory(): SubjectFactory {
		return SubjectFactory::new();
	}
}
