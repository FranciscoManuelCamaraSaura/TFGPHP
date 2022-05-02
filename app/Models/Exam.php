<?php

namespace App\Models;

use Database\Factories\ExamFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model {
	use HasFactory;

	protected $table = 'exam';
	protected $guarded = 'id';

	protected $fillable = [
		'course_id',
		'group_words',
		'event',
		'subject',
		'type_exam',
		'evaluation'
	];

	public $timestamps = false;

	public function group() {
		return $this -> hasMany('App\Models\Group', ['course_id', 'group_words']);
	}

	public function event() {
		return $this -> hasMany('App\Models\Event', 'event');
	}

	public function subject() {
		return $this -> hasMany('App\Models\Subject', 'subject');
	}

	public static function getEvent($id) {
		return Exam::where('event', '=', $id) -> get();
	}

	public static function getExamsByCourseGroupSubject($course_id, $group_words, $subject) {
		return Exam::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> where('subject', '=', $subject) -> get();
	}

	protected static function newFactory(): ExamFactory {
		return ExamFactory::new();
	}
}
