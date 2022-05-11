<?php

namespace App\Models;

use Database\Factories\ImpartFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impart extends Model {
	use HasFactory;

	protected $table = 'impart';
	protected $guarded = 'id';

	protected $fillable = [
		'course_id',
		'group_words',
		'subject',
		'teacher'
	];

	public $timestamps = false;

	public function group() {
		return $this -> hasMany('App\Models\Group', ['course_id', 'group_words']);
	}

	public function subject() {
		return $this -> hasMany('App\Models\Subject', 'subject');
	}

	public function teacher() {
		return $this -> hasMany('App\Models\Teacher', 'teacher');
	}

	public static function getByCourseGroup($course_id, $group_words) {
		return Impart::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> get();
	}

	public static function getTeachers($course_id, $group_words) {
		return Impart::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> get() -> pluck('teacher');
	}

	public static function getSubject($course_id, $group_words, $person) {
		return Impart::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> where('teacher', '=', $person) -> get();
	}

	public static function getSubjects($person) {
		return Impart::where('teacher', '=', $person) -> get();
	}

	public static function getCourseGroup($subject, $teacher) {
		return Impart::where('subject', '=', $subject) -> where('teacher', '=', $teacher) -> get();
	}

	public static function getCoursesGroups($person) {
		return Impart::where('teacher', '=', $person) -> get();
	}

	public static function getTeachersBySubject($subject) {
		return Impart::where('subject', '=', $subject) -> get();
	}

	public static function getTeacherByCourseGroupSubject($course_id, $group_words, $subject) {
		return Impart::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> where('subject', '=', $subject) -> first();
	}

	protected static function newFactory(): ImpartFactory {
		return ImpartFactory::new();
	}
}
