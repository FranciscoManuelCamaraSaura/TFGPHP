<?php

namespace App\Models;

use Database\Factories\GroupHavePreceptorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupHavePreceptor extends Model {
	use HasFactory;

	protected $table = 'group_have_preceptor';
	protected $guarded = 'id';

	protected $fillable = [
		'course_id',
		'group_words',
		'preceptor'
	];

	public $timestamps = false;

	public function course() {
		return $this -> hasOne('App\Models\Group', ['course_id', 'group_words']);
	}

	public function teacher() {
		return $this -> hasOne('App\Models\Teacher', 'person');
	}

	public static function getByPreceptor($preceptor) {
		return GroupHavePreceptor::where('preceptor', '=', $preceptor) -> first();
	}

	public static function getByCourseGroup($course_id, $group_words) {
		return GroupHavePreceptor::where('course_id', '=', $course_id) -> where('group_words', '=', $group_words) -> first();
	}

	protected static function newFactory(): GroupHavePreceptorFactory {
		return GroupHavePreceptorFactory::new();
	}
}
