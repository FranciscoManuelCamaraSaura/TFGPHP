<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller {
	public function index(Request $request) {
		$courses = Course::all();

		foreach($courses as $course) {
			if (intval($course -> school) === $request -> school_id) {
				$coursesOfSchool[] = $course;
			}
		}

		return $coursesOfSchool;
	}

	public function show(Request $request) {
		$course = Course::find($request -> id);

		return response()->json($course, 200);
	}
}
