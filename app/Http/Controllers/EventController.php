<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\Exam;
use App\Models\Impart;
use App\Models\Manager;
use App\Models\Person;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class EventController extends Controller {
	public function showWeb(Request $request) {
		$output = new \Symfony\Component\Console\Output\ConsoleOutput();
		//$output->writeln($request);
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			return view("events_menu", compact("school", "person", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function showApi(Request $request) {
		$managers = Manager::getManagerBySchool($request -> school_id);
		$events = array();

		foreach($managers as $manager) {
			$events[] = Event::getEventBySchoolResponsable($request -> school_id, $manager -> person);
		}

		$student = Student::findOrFail($request -> student_id);
		$imparts = Impart::getByCourseGroup($student -> course_id, $student -> group_words);

		foreach($imparts as $impart) {
			$events[] = Event::getEventBySchoolResponsable($request -> school_id, $impart -> teacher);
		}

		foreach($events as $eventByResponsable) {
			foreach($eventByResponsable as $event) {
				$event -> date = $event -> date + " 00:00:00";
				$calendar[] = $event;
			}
		}

		//$calendar["events"] = $events;
		//$calendar["holidays"] = $this -> checkHolidays();

		return response() -> json($calendar, 200);
	}

	public function calendar(Request $request) {
		if(isset($request -> id) && isset($request -> person)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$type_user = $request -> type_user;

			if(isset($request -> month)) {
				$month = $request -> month;
				$page = $request -> page;
				$page++;
			} else {
				$month = date("Y-m");
				$page = 1;
			}

			$data = $this -> month($month, $school, $person -> dni, $type_user);
			$month = $data["month"];

			$full_month = $this -> full_month($month);

			return view("calendar", compact("school", "person", "type_user", "data", "month", "full_month", "page"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	private function month($month, $school, $person, $type_user) {
		$first_date = date("Y/m/d", strtotime("first day of " . $month));
		$last_day = date("Y/m/d", strtotime("last day of " . $month));

		$day = date("d", strtotime($first_date));
		$month_of_month = date("m", strtotime($first_date));
		$year = date("Y", strtotime($first_date));

		$new_date = mktime(0, 0, 0, $month_of_month, $day, $year);
		$day_of_week = date("w", $new_date);
		$new_date = $new_date - ($day_of_week * 24 * 3600);

		$first_week = date("W", strtotime($first_date));
		$last_week = date("W", strtotime($last_day));

		$weeks = $this -> getWeeksOfMonth($month, $first_week, $last_week);
		$date = $this -> checkSunday($new_date);
		$calendar = $this -> getCalendar($date, $weeks, $school, $person, $type_user);

		$next_month = date("Y-m", strtotime($month . "+ 1 month"));
		$previus_month = date("Y-m", strtotime($month . "- 1 month"));
		$month = date("M", strtotime($month));

		$data = array(
			"next" => $next_month,
			"month"=> $month,
			"year" => $year,
			"previous" => $previus_month,
			"calendar" => $calendar,
		);

		return $data;
	}

	private function getWeeksOfMonth($month, $first_week, $last_week) {
		if(date("m", strtotime($month)) == 01) {
			$first_week = 0;

			return ($last_week - $first_week) + 1;
		} elseif(date("m", strtotime($month)) == 12) {
			return 5;
		} else  {
			return ($last_week - $first_week) + 1;
		}
	}

	private function checkSunday($new_date) {
		$date = date("Y/m/d", $new_date);
		$day = substr($date, 8);

		if($day == 01) {
			$previus_week = strtotime("last sunday midnight " . $date);
			$date = date("Y/m/d", $previus_week);
		}

		return $date;
	}

	private function getCalendar($date, $weeks, $school, $person, $type_user) {
		$calendar = array();
		$datesDisabled = $this -> checkHolidays();

		for($week = 0; $week < $weeks; $week++) {
			$week_days = array();

			for($days = 0; $days < 7; $days++) {
				$date = date("Y/m/d", strtotime($date . "+ 1 day"));

				$day_data["month"] = date("M", strtotime($date));
				$day_data["day"] = date("d", strtotime($date));

				if(!in_array($date, $datesDisabled)) {
					$day_data["events"] = $this -> checkEvent($date, $school, $person, $type_user);
					$day_data["holidays"] = false;
				} else {
					$day_data["holidays"] = true;
				}

				$week_days[] = $day_data;
			}

			$week_data["week"] = $week;
			$week_data["data"] = $week_days;

			$calendar[] = $week_data;
		}

		return $calendar;
	}

	private function checkHolidays() {
		$datesDisabled = array();

		// Días previos al inicio del curso
		$datesDisabled[] = "2021/09/01";
		$datesDisabled[] = "2021/09/02";
		$datesDisabled[] = "2021/09/03";
		$datesDisabled[] = "2021/09/06";
		$datesDisabled[] = "2021/09/07";

		// Días festivos
		$datesDisabled[] = "2021/10/12";
		$datesDisabled[] = "2021/11/01";
		$datesDisabled[] = "2021/12/06";
		$datesDisabled[] = "2021/12/08";

		// Vacaciones de Navidad
		$datesDisabled[] = "2021/12/23";
		$datesDisabled[] = "2021/12/24";
		$datesDisabled[] = "2021/12/27";
		$datesDisabled[] = "2021/12/28";
		$datesDisabled[] = "2021/12/29";
		$datesDisabled[] = "2021/12/30";
		$datesDisabled[] = "2021/12/31";
		$datesDisabled[] = "2022/01/03";
		$datesDisabled[] = "2022/01/04";
		$datesDisabled[] = "2022/01/05";
		$datesDisabled[] = "2022/01/06";
		$datesDisabled[] = "2022/01/07";

		// Vacaciones de Pascua
		$datesDisabled[] = "2022/04/14";
		$datesDisabled[] = "2022/04/15";
		$datesDisabled[] = "2022/04/18";
		$datesDisabled[] = "2022/04/19";
		$datesDisabled[] = "2022/04/20";
		$datesDisabled[] = "2022/04/21";
		$datesDisabled[] = "2022/04/22";
		$datesDisabled[] = "2022/04/25";

		// Días posteriores al fin del curso
		$datesDisabled[] = "2022/06/21";
		$datesDisabled[] = "2022/06/22";
		$datesDisabled[] = "2022/06/23";
		$datesDisabled[] = "2022/06/24";
		$datesDisabled[] = "2022/06/27";
		$datesDisabled[] = "2022/06/28";
		$datesDisabled[] = "2022/06/29";
		$datesDisabled[] = "2022/06/30";

		return $datesDisabled;
	}

	private function checkEvent($date, $school, $person, $type_user) {
		$managers = Manager::getManagerBySchool($school);
		$events = array();

		$day = substr($date, 8);
		$month = substr($date, 5, 2);
		$year = substr($date, 0, 4);
		$date = $day . "/" . $month . "/" . $year;

		if($type_user === "Teacher") {
			foreach($managers as $manager) {
				$events[] = Event::where("school", $school) -> where("date", $date) -> where("responsable", $manager -> person) -> get();
			}
	
			$events[] = Event::where("school", $school) -> where("date", $date) -> where("responsable", $person) -> get();
		} else {
			$events[] = Event::where("school", $school) -> where("date", $date) -> get();
		}

		return $events;
	}

	private function full_month($month) {
		switch ($month) {
			case "Jan":
				return "Enero";

			case "Feb":
				return "Febrero";
			
			case "Mar":
				return "Marzo";
			
			case "Apr":
				return "Abril";
			
			case "May":
				return "Mayo";
			
			case "Jun":
				return "Junio";
			
			case "Jul":
				return "Julio";
			
			case "Aug":
				return "Agosto";
			
			case "Sep":
				return "Septiembre";
			
			case "Oct":
				return "Octubre";
			
			case "Nov":
				return "Noviembre";
			
			case "Dec":
				return "Diciembre";
		}
	}

	public function insert(Request $request) {
		if (isset($request -> id) && isset($request -> person)) {
			$courses = array();
	
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$imparts = Impart::getCoursesGroups($person -> dni);

			foreach($imparts as $impart) {
				$course = Course::findOrFail($impart -> course_id);

				if($course -> school === intval($school) && !in_array($course, $courses)) {
					$courses[] = $course;
				}
			}

			$type_user = $request -> type_user;

			return view("new_event", compact("school", "person", "courses", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function insertEvent(Request $request) {
		$request -> validate([
			'school' => 'required|string',
			'date' => 'required|string',
			'person' => 'required|string',
			'name' => 'required|string',
			'description' => 'required|string',
			'duration' => 'required|integer',
		]);

		$event = new Event([
			'school' => $request -> school,
			'date' => $request -> date,
			'responsable' => Person::findOrFail($request -> person) -> dni,
			'name' => $request -> name,
			'description' => $request -> description,
			'duration' => $request -> duration
		]);

		$event -> save();

		return response() -> json($event, 200);
	}

	public function listEvents(Request $request) {
		if(isset($request -> id) && isset($request -> person) && isset($request -> type_user)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$events = Event::getEventBySchoolResponsable($school, $person -> dni);
			$created_exams = Exam::all();

			foreach($created_exams as $exam) {
				$events_id[] = $exam -> event;
			}

			$event_not_exam = array();
			$event_exam = array();
			$exams = array();
			$courses = array();

			foreach($events as $event) {
				if(!in_array($event -> id, $events_id)) {
					$event_not_exam[] = $event;
				} else {
					$event_exam[] = $event;
					$exam = Exam::getEvent($event -> id) -> first();
					$exams[] = $exam;
					$course = Course::findOrFail($exam -> course_id);
					$courses[] = $course -> number . " " . $course -> degree;
				}
			}

			$type_user = $request -> type_user;

			return view("edit_event", compact("school", "person", "event_not_exam", "event_exam", "exams", "courses", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	public function update(Request $request) {
		$courses = array();
		$courses_id = array();
		$subjects = array();

		if(isset($request -> id) && isset($request -> person) && isset($request -> type_user)) {
			$school = $request -> id;
			$person = Person::findOrFail($request -> person);
			$event = Event::findOrFail($request -> event);
			$exam = Exam::getEvent($event -> id) -> first();
			$type_user = $request -> type_user;

			if(isset($exam)) {
				$is_exam = true;
				$course = Course::findOrFail($exam -> course_id);
				$subject_default = Subject::getSubjectByCode($exam -> subject);
				$type_exam = $this -> getExamType($exam -> type_exam);
				$evaluation = $this -> getEvaluation($exam -> evaluation);
			} else {
				$is_exam = false;
				$course = "";
				$subject_default = "";
				$type_exam = "";
				$evaluation = "";
				$exam = $this -> getEmptyExam();
			}

			$imparts = Impart::getCoursesGroups($person -> dni);

			if($type_user === "Teacher") {
				foreach($imparts as $impart) {
					$course = Course::findOrFail($impart -> course_id);

					if($course -> school === intval($school) && !in_array($course -> id, $courses_id)) {
						$courses[] = $course;
						$courses_id[] = $course -> id;
					}

					if($course -> school === intval($school)) {
						$subjects[] = Subject::getSubjectByCode($impart -> subject);
					}
				}
			}

			return view("event", compact("school", "person", "event", "exam", "courses", "course", "subjects", "subject_default", "is_exam", "type_exam", "evaluation", "type_user"));
		} else {
			return response() -> json(["message" => "Invalid school"], 400);
		}
	}

	private function getExamType($type_exam) {
		$type_exam_conversion = "";

		switch($type_exam) {
			case "written":
				$type_exam_conversion = "Escrito";

				break;

			case "oral":
				$type_exam_conversion = "Oral";

				break;

			case "presentation":
				$type_exam_conversion = "Presentación";

				break;

			case "exhibition":
				$type_exam_conversion = "Expoxición";

				break;

			case "optional_work":
				$type_exam_conversion = "Trabajo adicional";

				break;

			case "homework":
				$type_exam_conversion = "Deberes";

				break;
		}

		return $type_exam_conversion;
	}

	private function getEvaluation($evaluation) {
		$evaluation_conversion = "";

		switch($evaluation) {
			case "first_trimester":
				$evaluation_conversion = "Primer trimestre";

				break;

			case "second_trimester":
				$evaluation_conversion = "Segundo trimestre";

				break;

			case "third_trimester":
				$evaluation_conversion = "Tercer trimestre";

				break;
		}

		return $evaluation_conversion;
	}

	private function getEmptyExam() {
		$exam = Exam::factory() -> make();

		$exam -> course_id = "";
		$exam -> group_words = "";
		$exam -> event = "";
		$exam -> subject = "";
		$exam -> type_exam = "";

		return $exam;
	}

	public function updateEvent(Request $request) {
		$request -> validate([
			'school' => 'required|string',
			'date' => 'required|string',
			'person' => 'required|string',
			'name' => 'required|string',
			'description' => 'required|string',
			'duration' => 'required|integer',
		]);

		$event = Event::findOrFail($request -> event);

		$event -> school = $request -> school;
		$event -> date = $request -> date;
		$event -> responsable = Person::findOrFail($request -> person) -> dni;
		$event -> name = $request -> name;
		$event -> description = $request -> description;
		$event -> duration = $request -> duration;

		$event -> save();

		return response() -> json($event, 200);
	}

	public function delete(Request $request) {
		$event = Event::findOrFail($request -> id);

		$event -> delete();

		return response() -> json(200);
	}

	public function checkEvents(Request $request) {
		$todaysEvents = 0;

		$events = $this -> checkTodayEvent($request -> school, $request -> receiver, $request -> today, $request -> type_user);
		$todaysEvents = count($events);

		return response() -> json(["todaysEvents" => $todaysEvents], 200);
	}

	private function checkTodayEvent($school, $person, $date, $type_user) {
		$managers = Manager::getManagerBySchool($school);

		if($type_user === "Teacher") {
			foreach ($managers as $manager) {
				$events = Event::where("school", $school) -> where("date", $date) -> where("responsable", $manager -> person) -> get();
			}
	
			$events = Event::where("school", $school) -> where("date", $date) -> where("responsable", $person) -> get();
		} else {
			$events = Event::where("school", $school) -> where("date", $date) -> get();
		}

		return $events;
	}
}
