<?php

namespace App\Models;

use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
	use HasFactory;

	protected $table = 'course';
	protected $guarded = 'id';
	
	protected $fillable = [
		'school',
		'degree',
		'number'
	];

	public $timestamps = false;

	public function school() {
		return $this -> hasOne('App\Models\School', 'id');
	}

	public function group() {
		return $this -> hasMany('App\Models\Group', 'course_id');
	}

	public static function getCourses($school) {
		return Course::where('school', '=', $school) -> get();
	}

	public static function getCourse($id) {
		return Course::where('number', '=', $id) -> get();
	}

	protected static function newFactory(): CourseFactory {
		return CourseFactory::new();
	}
}
