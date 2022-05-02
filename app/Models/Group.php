<?php

namespace App\Models;

use Database\Factories\GroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {
	use HasFactory;

	protected $table = 'group';

	protected $fillable = [
		'course_id',
		'group_words'
	];

	public $timestamps = false;

	public function course() {
		return $this -> belongsTo('App\Models\Course', 'course_id');
	}

	public function hasPreceptor() {
		return $this -> belongsTo('App\Models\GroupHavePreceptor', ['course_id', 'group_words']);
	}

	public function student() {
		return $this -> hasMany('App\Models\Student', ['course_id', 'group_words']);
	}

	public static function getGroup($course_id, $group_words) {
		return Group::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> get();
	}

	public static function getGroups($course_id) {
		return Group::where('course_id', '=', $course_id) -> get();
	}

	protected static function newFactory(): GroupFactory {
		return GroupFactory::new();
	}
}
