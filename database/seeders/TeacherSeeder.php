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
			['BBGG', 'Biología y Geología'],
			['GGHH', 'Geografía e Historia'],
			['LENG', 'Lengua Castellana y Literatura'],
			['MAT', 'Matemáticas'],
			['PLE', 'Primera Lengua Extranjera'],
			['FFQQ', 'Física y Química'],
			['MOAC', 'Matemáticas Orientadas a las Enseñanzas Académicas'],
			['MOAP', 'Matemáticas Orientadas a las Enseñanzas Aplicadas'],
			['ECO', 'Economía'],
			['LAT', 'Latín'],
			['TEC', 'Tecnología'],
			['EEFF', 'Educación Física'],
			['MUS', 'Música'],
			['EPVA', 'Educación Plástica, Visual y Audiovisual'],
			['VAL', 'Valenciano: Lengua y Literatura'],
			['REL', 'Religión'],
			['VVEE', 'Valores Éticos'],
			['CAAP', 'Ciencias Aplicadas a la Actividad Profesional'],
			['IAEE', 'Iniciación a la Actividad Emprendedora y Empresarial'],
			['CCLA', 'Cultura Clásica'],
			['SLE', 'Segunda Lengua Extranjera'],
			['AED', 'Artes Escénicas y Danza'],
			['CCIE', 'Cultura Científica'],
			['FILO', 'Filosofía'],
			['TIC', 'Tecnologías de la Información y la Comunicación'],
			['MCA', 'Materias del bloque de asignaturas troncales no cursadas anteriormente'],
			['INF', 'Informática'],
			['TTRR', 'Talleres de Refuerzo'],
			['TTPP', 'Talleres de Profundización'],
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
			['FILO', 'Filosofía'],
			['LEN1', 'Lengua Castellana y Literatura I'],
			['PLE1', 'Primera Lengua Extranjera I'],
			['HISE', 'Historia de España'],
			['LEN2', 'Lengua Castellana y Literatura II'],
			['PLE2', 'Primera Lengua Extranjera II'],
			['FA1', 'Fundamentos del Arte I'],
			['MAT1', 'Matemáticas I'],
			['MCS1', 'Matemáticas Aplicadas a las Ciencias Sociales I'],
			['LAT1', 'Latín I'],
			['FA2', 'Fundamentos del Arte II'],
			['MAT2', 'Matemáticas II'],
			['MCS2', 'Matemáticas Aplicadas a las Ciencias Sociales II'],
			['LAT2', 'Latín II'],
			['CAV1', 'Cultura Audiovisual I'],
			['FYQ1', 'Física y Química I'],
			['ECO', 'Economía'],
			['GRI1', 'Griego I'],
			['CAV2', 'Cultura Audiovisual II'],
			['AAEE', 'Artes Escénicas'],
			['DIS', 'Diseño'],
			['FIS', 'Física'],
			['QUI', 'Química'],
			['DT2', 'Dibujo Técnico II'],
			['BIO', 'Biología'],
			['GEO', 'Geología'],
			['GRI2', 'Griego II'],
			['EEEE', 'Economía de la Empresa'],
			['GEOG', 'Geografía'],
			['HISA', 'Historia del Arte'],
			['EEFF', 'Educación Física'],
			['HISF', 'Historia de la Filosofía'],
			['VAL1', 'Valenciano: Lengua y Literatura I'],
			['VAL2', 'Valenciano: Lengua y Literatura II'],
			['HMC', 'Historia del Mundo Contemporáneo'],
			['LLUU', 'Literatura Universal'],
			['DT1', 'Dibujo Técnico I'],
			['BYG', 'Biología y Geología'],
			['AM1', 'Análisis Musical I'],
			['AAAA', 'Anatomía Aplicada'],
			['CULC', 'Cultura Científica'],
			['DA1', 'Dibujo Artístico I'],
			['LPM', 'Lenguaje y Práctica Musical'],
			['REL', 'Religión'],
			['SLE1', 'Segunda Lengua Extranjera I'],
			['TI1', 'Tecnología Industrial I'],
			['TIC1', 'Tecnologías de la Información y la Comunicación I'],
			['VOL', 'Volumen'],
			['AM2', 'Análisis Musical II'],
			['CTMA', 'Ciencias de la Tierra y del Medio Ambiente'],
			['DA2', 'Dibujo Artístico II'],
			['FAG', 'Fundamentos de Administración y Gestión'],
			['HMD', 'Historia de la Música y de la Danza'],
			['HISF', 'Historia de la Filosofía'],
			['IISS', 'Imagen y Sonido'],
			['PSI', 'Psicología'],
			['SLE2', 'Segunda Lengua Extranjera II'],
			['TEG', 'Técnicas de Expresión Graficoplástica'],
			['TI2', 'Tecnología Industrial II'],
			['TIC2', 'Tecnologías de la Información y la Comunicación II'],
			['MACB', 'Materias del bloque de asignaturas troncales no cursadas anteriormente'],
			['EFS', 'Educación Fisicodeportiva y Salud']
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
