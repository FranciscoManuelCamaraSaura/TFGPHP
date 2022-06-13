<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makes extends Model {
	use HasFactory;

	protected $table = 'makes';
	protected $guarded = 'id';

	protected $fillable = [
		'student',
		'exam',
		'note'
	];

	public $timestamps = false;

	public function student() {
		return $this -> hasOne('App\Models\Student', 'student');
	}

	public function exam() {
		return $this -> hasOne('App\Models\Exam', 'exam');
	}

	public static function getNote($student, $exam) {
		return Makes::where('student', '=', $student) -> where('exam', '=', $exam) -> first();
	}
}
