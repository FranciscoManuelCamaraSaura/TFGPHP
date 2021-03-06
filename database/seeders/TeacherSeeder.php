<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$this -> preschool();
		$this -> primary();
		$this -> secundary();
		$this -> bachelor();
	}

	public function preschool() {
		$this -> makePreceptorOfPreschool(1, "A", "PRE_1");
		$this -> makePreceptorOfPreschool(1, "B", "PRE_1");
		$this -> makePreceptorOfPreschool(1, "C", "PRE_1");

		$this -> makePreceptorOfPreschool(2, "A", "PRE_2");
		$this -> makePreceptorOfPreschool(2, "B", "PRE_2");
		$this -> makePreceptorOfPreschool(2, "C", "PRE_2");
	}

	public function primary() {
		$this -> makePreceptorOfPrimary(1, "A");
		$this -> makePreceptorOfPrimary(1, "B");
		$this -> makePreceptorOfPrimary(1, "C");

		$this -> makePreceptorOfPrimary(2, "A");
		$this -> makePreceptorOfPrimary(2, "B");
		$this -> makePreceptorOfPrimary(2, "C");

		$this -> makePreceptorOfPrimary(3, "A");
		$this -> makePreceptorOfPrimary(3, "B");
		$this -> makePreceptorOfPrimary(3, "C");

		$this -> makePreceptorOfPrimary(4, "A");
		$this -> makePreceptorOfPrimary(4, "B");
		$this -> makePreceptorOfPrimary(4, "C");

		$this -> makePreceptorOfPrimary(5, "A");
		$this -> makePreceptorOfPrimary(5, "B");
		$this -> makePreceptorOfPrimary(5, "C");

		$this -> makePreceptorOfPrimary(6, "A");
		$this -> makePreceptorOfPrimary(6, "B");
		$this -> makePreceptorOfPrimary(6, "C");

		$this -> makeTeacherOfPrimary(0, "ALL");
	}

	public function secundary() {
		$this -> makePreceptorOfSecundary(1, "A");
		$this -> makePreceptorOfSecundary(1, "B");
		$this -> makePreceptorOfSecundary(1, "C");

		$this -> makePreceptorOfSecundary(2, "A");
		$this -> makePreceptorOfSecundary(2, "B");
		$this -> makePreceptorOfSecundary(2, "C");

		$this -> makePreceptorOfSecundary(3, "A");
		$this -> makePreceptorOfSecundary(3, "B");
		$this -> makePreceptorOfSecundary(3, "C");

		$this -> makePreceptorOfSecundary(4, "A");
		$this -> makePreceptorOfSecundary(4, "B");
		$this -> makePreceptorOfSecundary(4, "C");

		$this -> makeTeacherOfSecundary(0, "ALL");
	}

	public function bachelor() {
		$this -> makePreceptorOfBachelor(1, "A");
		$this -> makePreceptorOfBachelor(1, "B");
		$this -> makePreceptorOfBachelor(1, "C");
		$this -> makePreceptorOfBachelor(1, "D");

		$this -> makePreceptorOfBachelor(2, "A");
		$this -> makePreceptorOfBachelor(2, "B");
		$this -> makePreceptorOfBachelor(2, "C");
		$this -> makePreceptorOfBachelor(2, "D");

		$this -> makeTeacherOfBachelor(0, "ALL");
	}

	public function makePreceptorOfPreschool($course, $group, $subjectCode) {
		$subject = Subject::getSubjectByCode($subjectCode);
		$subjectCode = explode("_", $subject -> code);

		$surnames = $subjectCode[1];
		$name = $this -> makePreceptorName($course, $group, $subjectCode[0]);
		$preceptor = true;

		$this -> makeTeacher($name, $surnames, $preceptor);
	}

	public function makePreceptorOfPrimary($course, $group) {
		$surnames = "LDC";
		$name = $this -> makePreceptorName($course, $group, "PRI");
		$preceptor = true;

		$this -> makeTeacher($name, $surnames, $preceptor);
	}

	public function makeTeacherOfPrimary($course, $group) {
		$subjects = Subject::getSubjectByDegree("primary");

		foreach($subjects as $subject) {
			$this -> makeTeachersOfPrimaryBySubjects($course, $group, $subject);
		}
	}

	public function makeTeachersOfPrimaryBySubjects($course, $group, $subject) {
		$subjectCode = explode("_", $subject -> code);

		switch ($subjectCode[1]) {
			case "PLE":
				$surnames = $subjectCode[1];
				$name = $this -> makeTeacherName($course, $group, $subjectCode[0]);
				$preceptor = false;

				$this -> makeTeacher($name, $surnames, $preceptor);
			break;

			case "VAL":
				$surnames = $subjectCode[1];
				$name = $this -> makeTeacherName($course, $group, $subjectCode[0]);
				$preceptor = false;

				$this -> makeTeacher($name, $surnames, $preceptor);
			break;

			case "EEFF":
				$surnames = $subjectCode[1];
				$name = $this -> makeTeacherName($course, $group, $subjectCode[0]);
				$preceptor = false;

				$this -> makeTeacher($name, $surnames, $preceptor);
			break;

			case "REL":
				$surnames = $subjectCode[1];
				$name = $this -> makeTeacherName($course, $group, $subjectCode[0]);
				$preceptor = false;

				$this -> makeTeacher($name, $surnames, $preceptor);
			break;
		}
	}

	public function makePreceptorOfSecundary($course, $group) {
		$surnames = "TUT";
		$name = $this -> makePreceptorName($course, $group, "SEC");
		$preceptor = true;

		$this -> makeTeacher($name, $surnames, $preceptor);
	}

	public function makeTeacherOfSecundary($course, $group) {
		$subjects = [
			['BBGG', 'Biolog??a y Geolog??a'],
			['GGHH', 'Geograf??a e Historia'],
			['LENG', 'Lengua Castellana y Literatura'],
			['MAT', 'Matem??ticas'],
			['PLE', 'Primera Lengua Extranjera'],
			['FFQQ', 'F??sica y Qu??mica'],
			['MOAC', 'Matem??ticas Orientadas a las Ense??anzas Acad??micas'],
			['MOAP', 'Matem??ticas Orientadas a las Ense??anzas Aplicadas'],
			['ECO', 'Econom??a'],
			['LAT', 'Lat??n'],
			['TEC', 'Tecnolog??a'],
			['EEFF', 'Educaci??n F??sica'],
			['MUS', 'M??sica'],
			['EPVA', 'Educaci??n Pl??stica, Visual y Audiovisual'],
			['VAL', 'Valenciano: Lengua y Literatura'],
			['REL', 'Religi??n'],
			['VVEE', 'Valores ??ticos'],
			['CAAP', 'Ciencias Aplicadas a la Actividad Profesional'],
			['IAEE', 'Iniciaci??n a la Actividad Emprendedora y Empresarial'],
			['CCLA', 'Cultura Cl??sica'],
			['SLE', 'Segunda Lengua Extranjera'],
			['AED', 'Artes Esc??nicas y Danza'],
			['CCIE', 'Cultura Cient??fica'],
			['FILO', 'Filosof??a'],
			['TIC', 'Tecnolog??as de la Informaci??n y la Comunicaci??n'],
			['MCA', 'Materias del bloque de asignaturas troncales no cursadas anteriormente'],
			['INF', 'Inform??tica'],
			['TTRR', 'Talleres de Refuerzo'],
			['TTPP', 'Talleres de Profundizaci??n'],
			['PPII', 'Proyecto Interdisciplinario'],
			['CCOl', 'Competencia Comunicativa Oral Primera Lengua Extranjera']
		];

		foreach($subjects as $subject) {
			$this -> makeTeachersOfSecundaryBySubjects($course, $group, $subject);
		}
	}

	public function makeTeachersOfSecundaryBySubjects($course, $group, $subject) {
		$surnames = $subject[0];
		$name = $this -> makeTeacherName($course, $group, "SEC");
		$preceptor = false;

		$this -> makeTeacher($name, $surnames, $preceptor);
	}

	public function makePreceptorOfBachelor($course, $group) {
		$surnames = "TUT";
		$name = $this -> makePreceptorName($course, $group, "BACH");
		$preceptor = true;

		$this -> makeTeacher($name, $surnames, $preceptor);
	}

	public function makeTeacherOfBachelor($course, $group) {
		$subjects = [
			['FILO', 'Filosof??a'],
			['LEN1', 'Lengua Castellana y Literatura I'],
			['PLE1', 'Primera Lengua Extranjera I'],
			['HISE', 'Historia de Espa??a'],
			['LEN2', 'Lengua Castellana y Literatura II'],
			['PLE2', 'Primera Lengua Extranjera II'],
			['FA1', 'Fundamentos del Arte I'],
			['MAT1', 'Matem??ticas I'],
			['MCS1', 'Matem??ticas Aplicadas a las Ciencias Sociales I'],
			['LAT1', 'Lat??n I'],
			['FA2', 'Fundamentos del Arte II'],
			['MAT2', 'Matem??ticas II'],
			['MCS2', 'Matem??ticas Aplicadas a las Ciencias Sociales II'],
			['LAT2', 'Lat??n II'],
			['CAV1', 'Cultura Audiovisual I'],
			['FYQ1', 'F??sica y Qu??mica I'],
			['ECO', 'Econom??a'],
			['GRI1', 'Griego I'],
			['CAV2', 'Cultura Audiovisual II'],
			['AAEE', 'Artes Esc??nicas'],
			['DIS', 'Dise??o'],
			['FIS', 'F??sica'],
			['QUI', 'Qu??mica'],
			['DT2', 'Dibujo T??cnico II'],
			['BIO', 'Biolog??a'],
			['GEO', 'Geolog??a'],
			['GRI2', 'Griego II'],
			['EEEE', 'Econom??a de la Empresa'],
			['GEOG', 'Geograf??a'],
			['HISA', 'Historia del Arte'],
			['EEFF', 'Educaci??n F??sica'],
			['HISF', 'Historia de la Filosof??a'],
			['VAL1', 'Valenciano: Lengua y Literatura I'],
			['VAL2', 'Valenciano: Lengua y Literatura II'],
			['HMC', 'Historia del Mundo Contempor??neo'],
			['LLUU', 'Literatura Universal'],
			['DT1', 'Dibujo T??cnico I'],
			['BYG', 'Biolog??a y Geolog??a'],
			['AM1', 'An??lisis Musical I'],
			['AAAA', 'Anatom??a Aplicada'],
			['CULC', 'Cultura Cient??fica'],
			['DA1', 'Dibujo Art??stico I'],
			['LPM', 'Lenguaje y Pr??ctica Musical'],
			['REL', 'Religi??n'],
			['SLE1', 'Segunda Lengua Extranjera I'],
			['TI1', 'Tecnolog??a Industrial I'],
			['TIC1', 'Tecnolog??as de la Informaci??n y la Comunicaci??n I'],
			['VOL', 'Volumen'],
			['AM2', 'An??lisis Musical II'],
			['CTMA', 'Ciencias de la Tierra y del Medio Ambiente'],
			['DA2', 'Dibujo Art??stico II'],
			['FAG', 'Fundamentos de Administraci??n y Gesti??n'],
			['HMD', 'Historia de la M??sica y de la Danza'],
			['HISF', 'Historia de la Filosof??a'],
			['IISS', 'Imagen y Sonido'],
			['PSI', 'Psicolog??a'],
			['SLE2', 'Segunda Lengua Extranjera II'],
			['TEG', 'T??cnicas de Expresi??n Graficopl??stica'],
			['TI2', 'Tecnolog??a Industrial II'],
			['TIC2', 'Tecnolog??as de la Informaci??n y la Comunicaci??n II'],
			['MACB', 'Materias del bloque de asignaturas troncales no cursadas anteriormente'],
			['EFS', 'Educaci??n Fisicodeportiva y Salud']
		];

		foreach($subjects as $subject) {
			$this -> makeTeachersOfBachelorBySubjects($course, $group, $subject);
		}
	}

	public function makeTeachersOfBachelorBySubjects($course, $group, $subject) {
		$surnames = $subject[0];
		$name = $this -> makeTeacherName($course, $group, "BACH");
		$preceptor = false;

		$this -> makeTeacher($name, $surnames, $preceptor);
	}

	public function makePreceptorName($courseNumber, $groupWords, $subjectCode) {
		return "Preceptor " . $courseNumber . " " . $groupWords . " " . $subjectCode;
	}

	public function makeTeacherName($courseNumber, $groupWords, $subjectCode) {
		return "Teacher " . $courseNumber . " " . $groupWords . " " . $subjectCode;
	}

	public function makeTeacher($name, $surnames, $preceptor) {
		$teacher = Teacher::factory() -> create([
			'preceptor' => $preceptor,
		]);

		$person = Person::getDNIPerson($teacher -> person);

		$person -> name = $name;
		$person -> surnames = $surnames;

		$person -> save();

		return $teacher;
	}
}
