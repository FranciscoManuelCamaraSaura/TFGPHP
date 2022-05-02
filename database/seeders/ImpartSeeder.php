<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Group;
use App\Models\Impart;
use App\Models\Person;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ImpartSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table('impart') -> delete();

		$subjectType = [
			['ESP2', 'Específicas 2 (1 Random)'],
			['TO2', 'Troncales de opción 2 (1 Random)'],
			['EEOO', 'Específicas de opción (1 Random)'],
			['LCAO', 'Libre configuración autonómica de opción (1 Random)'],
			['TOM2', 'Troncal de opción de modalidad (2 Random)'],
			['TOM2', 'Troncales de opción de modalidad (1 Random)'],
			['EOB', 'Específicas de opción (2 Random)'],
			['LCAV', 'Libre configuración autonómica (voluntaria)']
		];

		$groups = Group::get();

		foreach($groups as $group) {
			$course = Course::find($group -> course_id);

			if($course -> school == 1 || $course -> school == 2) {
				switch($course -> degree) {
					case "preschool":
						if ($course -> number == 1) {
							$this -> makeImpartForPreschool($course, $group, "PRE_1");
						} else {
							$this -> makeImpartForPreschool($course, $group, "PRE_2");
						}

						break;

					case "primary":
						$this -> makeImpartForPrimary($course, $group);

						break;

					case "secundary":
						$this -> makeImpartForSecundary($course, $group);

						break;

					case "bachelor":
						$this -> makeImpartForBachelor($course, $group);

						break;
				}
			}
		}
	}

	public function makeImpartForPreschool($course, $group, $subjectCode) {
		$subject = Subject::getSubjectByCode($subjectCode);
		$teacher = Person::getTeacherByName($course -> number . " " . $group -> group_words . " PRE");

		$this -> createImpart($group, $subject, $teacher);
	}

	public function makeImpartForPrimary($course, $group) {
		$subjects = Subject::getSubjectByDegree($course -> degree);

		foreach($subjects as $subject) {
			$this -> makeImpartForPrimaryBySubjects($course, $group, $subject);
		}
	}

	public function makeImpartForPrimaryBySubjects($course, $group, $subject) {
		$subjectCode = explode("_", $subject -> code);

		switch($subjectCode[1]) {
			case "PLE":
			case "VAL":
			case "EEFF":
			case "REL":
				$teacher = Person::getTeacherByNameSurname("0 ALL PRI", $subjectCode[1]);

			break;

			default:
				$teacher = Person::getTeacherByNameSurname($course -> number . " " . $group -> group_words . " PRI", "LDC");

			break;
		}

		$this -> createImpart($group, $subject, $teacher);
	}

	public function makeImpartForSecundary($course, $group) {
		$subjectType = [
			['Troncales generales'],
			['Troncales de opción'],
			['Específicas (secundaria)'],
			['Libre configuración autonómica (secundaria)'],
			['Específicas 2 (1 Random)'],
			['Troncales de opción 2 (1 Random)'],
			['Específicas de opción (1 Random)'],
			['Libre configuración autonómica de opción (1 Random)']
		];

		// Troncales generales
		if ($course -> number != 4) {
			$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[0]);
		} else {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[0]);
		}

		foreach($subjects as $subject) {
			$this -> makeImpartForSecundaryBySubjects($course, $group, $subject);
		}

		// Troncales de opción
		if ($course -> number == 4) {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[1]);

			foreach($subjects as $subject) {
				$this -> makeImpartForSecundaryBySubjects($course, $group, $subject);
			}
		}

		// Específicas
		if ($course -> number != 4) {
			$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[2]);
		} else {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[2]);
		}

		foreach($subjects as $subject) {
			$this -> makeImpartForSecundaryBySubjects($course, $group, $subject);
		}

		// Libre configuración autonómica
		if ($course -> number != 4) {
			$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[3]);
		} else {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[3]);
		}

		foreach($subjects as $subject) {
			$this -> makeImpartForSecundaryBySubjects($course, $group, $subject);
		}

		// Específicas 2 (1 Random)
		if ($course -> number != 4) {
			$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[4]);
		} else {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[4]);
		}

		$element = rand(0, count($subjects) - 1);

		$this -> makeImpartForSecundaryBySubjects($course, $group, $subjects[$element]);

		// Troncales de opción 2 (1 Random)
		if ($course -> number == 3 || ($course -> number == 4 && $group -> group_words === "C")) {
			$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[5]);
			$element = rand(0, count($subjects) - 1);
	
			$this -> makeImpartForSecundaryBySubjects($course, $group, $subjects[$element]);
		}

		// Específicas de opción (1 Random)
		if ($course -> number != 1 && $course -> number != 2) {
			if ($course -> number != 4) {
				$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[6]);
			} else {
				$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[6]);
			}

			$element = rand(0, count($subjects) - 1);
	
			$this -> makeImpartForSecundaryBySubjects($course, $group, $subjects[$element]);
		}

		// Libre configuración autonómica de opción (1 Random)
		if ($course -> number != 4) {
			$subjects = Subject::getSubjectByDegreeCourseType($course -> degree, $course -> number, $subjectType[7]);
		} else {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[7]);
		}

		$element = rand(0, count($subjects) - 1);

		$this -> makeImpartForSecundaryBySubjects($course, $group, $subjects[$element]);
	}

	public function makeImpartForSecundaryBySubjects($course, $group, $subject) {
		$subjectCode = explode("_", $subject -> code);

		if ($subjectCode[2] === "TUT") {
			$teacher = Person::getTeacherByNameSurname($course -> number . " " . $group -> group_words . " SEC", "TUT");
		} else {
			$teacher = Person::getTeacherByNameSurname("0 ALL SEC", $subjectCode[2]);
		}

		$this -> createImpart($group, $subject, $teacher);
	}

	public function makeImpartForBachelor($course, $group) {
		$subjectType = [
			['Troncales generales'],
			['Troncal general de modalidad'],
			['Troncal de opción de modalidad'],
			['Troncal de opción de modalidad (2 Random)'],
			['Específicas (bachiller)'],
			['Libre configuración autonómica (bachiller)'],
			['Troncales de opción de modalidad (1 Random)'],
			['Específicas de opción (2 Random)'],
			['Libre configuración autonómica (voluntaria)']
		];

		// Troncales generales
		$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[0]);

		foreach($subjects as $subject) {
			$this -> makeImpartForBachelorBySubjects($course, $group, $subject);
		}

		// Troncal general de modalidad
		$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[1]);

		$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[0]);

		// Troncal de opción de modalidad 1º
		if ($course -> number == 1) {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[2]);

			$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[0]);
		}

		// Troncal de opción de modalidad 2º
		if ($course -> number == 2) {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[3]);

			$randomElements = $this -> getRandomElements($subjects);

			foreach($randomElements as $element) {
				$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[$element]);
			}
		}

		// Específicas
		if ($course -> number != 4 && $group -> group_words !== "A") {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[4]);

			$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[0]);
		}

		// Libre configuración autonómica
		$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[5]);

		foreach($subjects as $subject) {
			$this -> makeImpartForBachelorBySubjects($course, $group, $subject);
		}

		// Troncales de opción de modalidad
		if ($course -> number == 1) {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[6]);

			$element = rand(0, count($subjects) - 1);

			$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[$element]);
		}

		// Específicas de opción
		$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[7]);

		$randomElements = $this -> getRandomElements($subjects);

		foreach($randomElements as $element) {
			$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[$element]);
		}

		// Libre configuración autonómica (voluntaria)
		if ($course -> number == 2) {
			$subjects = Subject::getSubjectByDegreeCourseGroupType($course -> degree, $course -> number, $group -> group_words, $subjectType[8]);

			$this -> makeImpartForBachelorBySubjects($course, $group, $subjects[0]);
		}
	}

	public function makeImpartForBachelorBySubjects($course, $group, $subject) {
		$subjectCode = explode("_", $subject -> code);

		if ($subjectCode[2] === "TUT") {
			$teacher = Person::getTeacherByNameSurname($course -> number . " " . $group -> group_words . " BACH", "TUT");
		} else {
			$teacher = Person::getTeacherByNameSurname("0 ALL BACH", $subjectCode[2]);
		}

		$this -> createImpart($group, $subject, $teacher);
	}

	public function getRandomElements($subjects) {
		$i = 0;
		$randomElements = [];

		while($i < 2) {
			$element = rand(0, count($subjects) - 1);

			if (!in_array($element, $randomElements)) {
				$randomElements[] = $element;
				$i++;
			}
		}

		return $randomElements;
	}

	public function createImpart($group, $subject, $teacher) {
		$impart = new Impart([
			'course_id' => $group -> course_id,
			'group_words' => $group -> group_words,
			'subject' => $subject -> code,
			'teacher' => $teacher -> dni
		]);

		$impart -> save();
	}
}
