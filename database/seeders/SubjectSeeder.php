<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$degreeCodes = [['PRE', 'preschool'], ['PRI', 'primary'], ['SEC', 'secundary'], ['BACH', 'bachelor']];

		$subjectType = [
			['TTGG', 'Troncales generales'],
			['TO1', 'Troncales de opción'],
			['ESP1', 'Específicas (secundaria)'],
			['LCA1', 'Libre configuración autonómica (secundaria)'],
			['ESP2', 'Específicas 2 (1 Random)'],
			['TO2', 'Troncales de opción 2 (1 Random)'],
			['EEOO', 'Específicas de opción (1 Random)'],
			['LCAO', 'Libre configuración autonómica de opción (1 Random)'],
			['TGM', 'Troncal general de modalidad'],
			['TOM1', 'Troncal de opción de modalidad'],
			['TOM2', 'Troncal de opción de modalidad (2 Random)'],
			['ESP2', 'Específicas (bachiller)'],
			['LCA1', 'Libre configuración autonómica (bachiller)'],
			['TOM2', 'Troncales de opción de modalidad (1 Random)'],
			['EOB', 'Específicas de opción (2 Random)'],
			['LCAV', 'Libre configuración autonómica (voluntaria)']
		];

		// Preschool
		$this -> makePreschoolSubjects($degreeCodes[0], $subjectType[0], "1");
		$this -> makePreschoolSubjects($degreeCodes[0], $subjectType[0], "2");

		// Primary
		$primarySubjects = [
			['CCNN', 'Ciencias de la naturaleza'],
			['CCSS', 'Ciencias sociales'],
			['LENG', 'Lengua Castellana y Literatura'],
			['MAT', 'Matemáticas'],
			['PLE', 'Primera Lengua Extranjera'],
			['VAL', 'Valenciano: Lengua y Literatura'],
			['EEFF', 'Educación Física'],
			['REL', 'Religión'],
			['VSC', 'Valores Sociales y Cívicos'],
			['EEAA', 'Educación Artística'],
			['LDC', 'Libre disposición del centro']
		];

		$this -> makePrimarySubjects($degreeCodes[1], $subjectType[0], $primarySubjects);

		// Secundary

		// Troncales generales
		$secundarySubjectsTroncalesGenerales = [
			['BBGG', 'Biología y Geología'],
			['GGHH', 'Geografía e Historia'],
			['LENG', 'Lengua Castellana y Literatura'],
			['MAT', 'Matemáticas'],
			['PLE', 'Primera Lengua Extranjera'],
			['FFQQ', 'Física y Química'],
			['MOAC', 'Matemáticas Orientadas a las Enseñanzas Académicas'],
			['MOAP', 'Matemáticas Orientadas a las Enseñanzas Aplicadas']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[0], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[1], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[2], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[3], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[4], 1, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[5], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[1], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[2], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[3], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[4], 2, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[5], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[1], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[2], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[4], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[1], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[2], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[4], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[6], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[1], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[2], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[4], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[6], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[1], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[2], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[4], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[0], $secundarySubjectsTroncalesGenerales[7], 4, "C");

		// Troncales de opción
		$secundarySubjectsTroncalesOpcion = [
			['BBGG', 'Biología y Geología'],
			['FFQQ', 'Física y Química'],
			['ECO', 'Economía'],
			['LAT', 'Latín'],
			['TEC', 'Tecnología']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[1], $secundarySubjectsTroncalesOpcion[0], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[1], $secundarySubjectsTroncalesOpcion[1], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[1], $secundarySubjectsTroncalesOpcion[2], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[1], $secundarySubjectsTroncalesOpcion[3], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[1], $secundarySubjectsTroncalesOpcion[4], 4, "C");

		// Especificas
		$secundarySubjectsEspecificas = [
			['EEFF', 'Educación Física'],
			['MUS', 'Música'],
			['TEC', 'Tecnología'],
			['EPVA', 'Educación Plástica, Visual y Audiovisual']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[0], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[1], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[2], 1, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[0], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[1], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[2], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[3], 2, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[1], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[3], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[0], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[0], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[2], $secundarySubjectsEspecificas[0], 4, "C");

		// Libre configuración autonómica
		$secundarySubjectsLibreAutonomica = [
			['VAL', 'Valenciano: Lengua y Literatura'],
			['TUT', 'Tutoría']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[0], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[1], 1, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[0], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[1], 2, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[1], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[0], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[1], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[0], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[1], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[0], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[3], $secundarySubjectsLibreAutonomica[1], 4, "C");

		// Especificas 2
		$secundarySubjectsEspecificas2 = [
			['REL', 'Religión'],
			['VVEE', 'Valores Éticos']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[0], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[1], 1, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[0], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[1], 2, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[1], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[0], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[1], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[0], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[1], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[0], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[4], $secundarySubjectsEspecificas2[1], 4, "C");

		// Troncales de opción 2
		$secundarySubjectsTroncalesOpcion2 = [
			['MOAC', 'Matemáticas Orientadas a las Enseñanzas Académicas'],
			['MOAP', 'Matemáticas Orientadas a las Enseñanzas Aplicadas'],
			['CAAP', 'Ciencias Aplicadas a la Actividad Profesional'],
			['IAEE', 'Iniciación a la Actividad Emprendedora y Empresarial']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[5], $secundarySubjectsTroncalesOpcion2[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[5], $secundarySubjectsTroncalesOpcion2[1], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[5], $secundarySubjectsTroncalesOpcion2[2], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[5], $secundarySubjectsTroncalesOpcion2[3], 4, "C");

		// Especificas de opción
		$secundarySubjectsEspecíficasOpcion = [
			['CCLA', 'Cultura Clásica'],
			['TEC', 'Tecnología'],
			['IAEE', 'Iniciación a la Actividad Emprendedora y Empresarial'],
			['SLE', 'Segunda Lengua Extranjera'],
			['AED', 'Artes Escénicas y Danza'],
			['CCIE', 'Cultura Científica'],
			['EPVA', 'Educación Plástica, Visual y Audiovisual'],
			['FILO', 'Filosofía'],
			['MUS', 'Música'],
			['TIC', 'Tecnologías de la Información y la Comunicación'],
			['MCA', 'Materias del bloque de asignaturas troncales no cursadas anteriormente']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[1], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[2], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[3], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[4], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[5], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[0], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[6], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[7], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[8], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[3], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[9], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[10], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[4], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[5], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[0], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[6], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[7], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[8], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[3], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[9], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[10], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[4], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[5], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[0], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[6], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[7], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[8], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[3], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[9], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[6], $secundarySubjectsEspecíficasOpcion[10], 4, "C");

		// Libre configuración autonómica de opción
		$secundarySubjectsLibreAutonomicaOpcion = [
			['INF', 'Informática'],
			['TTRR', 'Talleres de Refuerzo'],
			['TTPP', 'Talleres de Profundización'],
			['PPII', 'Proyecto Interdisciplinario'],
			['CCLA', 'Cultura Clásica'],
			['EPVA', 'Educación Plástica, Visual y Audiovisual'],
			['IAEE', 'Iniciación a la Actividad Emprendedora y Empresarial'],
			['SLE', 'Segunda Lengua Extranjera'],
			['TEC', 'Tecnología'],
			['CCOl', 'Competencia Comunicativa Oral Primera Lengua Extranjera']
		];

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[0], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[1], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[2], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[3], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[4], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[5], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[6], 1, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[7], 1, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[0], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[1], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[2], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[3], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[4], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[6], 2, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[7], 2, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[0], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[8], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[1], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[2], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[3], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[4], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[6], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[9], 3, "");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[7], 3, "");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[9], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[1], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[2], 4, "A");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[3], 4, "A");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[9], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[1], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[2], 4, "B");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[3], 4, "B");

		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[9], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[1], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[2], 4, "C");
		$this -> makeSecundarySubjects($degreeCodes[2], $subjectType[7], $secundarySubjectsLibreAutonomicaOpcion[3], 4, "C");

		// Bachellor

		// Troncales generales
		$bachelorSubjectsTroncalesGenerales = [
			['FILO', 'Filosofía'],
			['LEN1', 'Lengua Castellana y Literatura I'],
			['PLE1', 'Primera Lengua Extranjera I'],
			['HISE', 'Historia de España'],
			['LEN2', 'Lengua Castellana y Literatura II'],
			['PLE2', 'Primera Lengua Extranjera II']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[0], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[1], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[2], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[0], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[1], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[2], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[0], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[1], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[2], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[0], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[1], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[2], 1, "D");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[3], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[4], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[5], 2, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[3], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[4], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[5], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[3], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[4], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[5], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[3], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[4], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[0], $bachelorSubjectsTroncalesGenerales[5], 2, "D");

		// Troncal general de modalidad
		$bachelorSubjectsTroncalesGeneralesModalidad = [
			['FA1', 'Fundamentos del Arte I'],
			['MAT1', 'Matemáticas I'],
			['MCS1', 'Matemáticas Aplicadas a las Ciencias Sociales I'],
			['LAT1', 'Latín I'],
			['FA2', 'Fundamentos del Arte II'],
			['MAT2', 'Matemáticas II'],
			['MCS2', 'Matemáticas Aplicadas a las Ciencias Sociales II'],
			['LAT2', 'Latín II']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[0], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[1], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[2], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[3], 1, "D");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[4], 2, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[5], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[6], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[8], $bachelorSubjectsTroncalesGeneralesModalidad[7], 2, "D");

		// Troncales de opción de modalidad de 1º
		$bachelorSubjectsTroncalesOpcionModalidadA = [
			['CAV1', 'Cultura Audiovisual I'],
			['FYQ1', 'Física y Química I'],
			['ECO', 'Economía'],
			['GRI1', 'Griego I']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[9], $bachelorSubjectsTroncalesOpcionModalidadA[0], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[9], $bachelorSubjectsTroncalesOpcionModalidadA[1], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[9], $bachelorSubjectsTroncalesOpcionModalidadA[2], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[9], $bachelorSubjectsTroncalesOpcionModalidadA[3], 1, "D");


		// Troncales de opción de modalidad de 2º
		$bachelorSubjectsTroncalesOpcionModalidadB = [
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
			['HISA', 'Historia del Arte']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[0], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[1], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[2], 2, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[3], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[4], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[5], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[6], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[7], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[8], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[9], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[10], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[11], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[8], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[9], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[10], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[10], $bachelorSubjectsTroncalesOpcionModalidadB[11], 2, "D");


		// Especificas
		$bachelorSubjectsEspecificas = [
			['EEFF', 'Educación Física'],
			['HISF', 'Historia de la Filosofía']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[0], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[0], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[0], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[0], 1, "D");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[1], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[1], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[11], $bachelorSubjectsEspecificas[1], 2, "D");

		// Libre configuración autonómica
		$bachelorSubjectsLibreAutonomica = [
			['VAL1', 'Valenciano: Lengua y Literatura I'],
			['VAL2', 'Valenciano: Lengua y Literatura II'],
			['TUT', 'Tutoría']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[0], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[0], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[0], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[0], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 1, "D");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[1], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 2, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[1], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[1], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[1], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[12], $bachelorSubjectsLibreAutonomica[2], 2, "D");

		// Troncales de opción de modalidad
		$bachelorSubjectsTroncalesOpcionModalidad2 = [
			['HMC', 'Historia del Mundo Contemporáneo'],
			['LLUU', 'Literatura Universal'],
			['DT1', 'Dibujo Técnico I'],
			['BYG', 'Biología y Geología']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[0], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[1], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[2], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[3], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[0], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[1], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[0], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[13], $bachelorSubjectsTroncalesOpcionModalidad2[1], 1, "D");

		// Especificas de opción
		$bachelorSubjectsEspecificasOpcion = [
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
			['MACB', 'Materias del bloque de asignaturas troncales no cursadas anteriormente']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[0], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[1], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[2], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[3], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[4], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[5], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[6], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[7], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[8], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[9], 1, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 1, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[0], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[1], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[2], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[3], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[4], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[5], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[6], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[7], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[8], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[9], 1, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 1, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[0], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[1], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[2], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[3], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[4], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[5], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[6], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[7], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[8], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[9], 1, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 1, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[0], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[1], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[2], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[3], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[4], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[5], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[6], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[7], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[8], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[9], 1, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 1, "D");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[10], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[11], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[12], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[13], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[14], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[15], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[16], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[17], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[18], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[19], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[20], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[21], 2, "A");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 2, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[10], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[11], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[12], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[13], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[14], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[16], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[17], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[18], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[19], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[20], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[21], 2, "B");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[10], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[11], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[12], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[13], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[14], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[16], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[17], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[18], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[19], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[20], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[21], 2, "C");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[10], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[11], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[12], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[13], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[14], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[16], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[17], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[18], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[19], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[20], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[21], 2, "D");
		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[14], $bachelorSubjectsEspecificasOpcion[22], 2, "D");

		$bachelorSubjectsLibreAutonomicaVoluntaria = [
			['EFS', 'Educación Fisicodeportiva y Salud']
		];

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[15], $bachelorSubjectsLibreAutonomicaVoluntaria[0], 2, "A");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[15], $bachelorSubjectsLibreAutonomicaVoluntaria[0], 2, "B");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[15], $bachelorSubjectsLibreAutonomicaVoluntaria[0], 2, "C");

		$this -> makeBachellorSubjects($degreeCodes[3], $subjectType[15], $bachelorSubjectsLibreAutonomicaVoluntaria[0], 2, "D");
	}

	public function makePreschoolSubjects($degreeCodes, $subjectType, $preschoolCourse) {
		$subject = new Subject([
			'code' => $degreeCodes[0] . '_' . $preschoolCourse,
			'name' => 'Explocarión del mundo ' . $preschoolCourse,
			'description' => 'Explocarión del mundo ' . $preschoolCourse . ' del grado de ' . $degreeCodes[1],
			'degree' => $degreeCodes[1],
			'number' => $preschoolCourse,
			'type' => $subjectType[1]
		]);

		$subject -> save();
	}

	public function makePrimarySubjects($degreeCodes, $subjectType, $primarySubjects) {
		foreach ($primarySubjects as $subjectData) {
			$subject = new Subject([
				'code' => $degreeCodes[0] . '_' . $subjectData[0],
				'name' => $subjectData[1],
				'description' => $subjectData[1] . ' del grado de ' . $degreeCodes[1],
				'degree' => $degreeCodes[1],
				'type' => $subjectType[1]
			]);

			$subject -> save();
		}
	}

	public function makeSecundarySubjects($degreeCodes, $subjectType, $subjectData, $courseNumber, $groupWords) {
		if ($groupWords === "") {
			$code = $degreeCodes[0] . '_' . $subjectType[0] . '_' . $subjectData[0] . '_' . $courseNumber;
		} else {
			$code = $degreeCodes[0] . '_' . $subjectType[0] . '_' . $subjectData[0] . '_' . $courseNumber . '_' . $groupWords;
		}

		$subject = new Subject([
			'code' => $code,
			'name' => $subjectData[1],
			'description' => 'Asignatura ' . $subjectType[1] . ': ' . $subjectData[1] . ' del grado de ' . $degreeCodes[1],
			'degree' => $degreeCodes[1],
			'number' => $courseNumber,
			'group_words' => $groupWords,
			'type' => $subjectType[1]
		]);

		$subject -> save();
	}

	public function makeBachellorSubjects($degreeCodes, $subjectType, $subjectData, $courseNumber, $groupWords) {
		$subject = new Subject([
			'code' => $degreeCodes[0] . '_' . $subjectType[0] . '_' . $subjectData[0] . '_' . $courseNumber . '_' . $groupWords,
			'name' => $subjectData[1],
			'description' => 'Asignatura ' . $subjectType[1] . ': ' . $subjectData[1] . ' del grado de ' . $degreeCodes[1],
			'degree' => $degreeCodes[1],
			'number' => $courseNumber,
			'group_words' => $groupWords,
			'type' => $subjectType[1]
		]);

		$subject -> save();
	}
}
