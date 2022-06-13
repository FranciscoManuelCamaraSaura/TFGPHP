<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\GroupHavePreceptor;
use App\Models\Manager;
use App\Models\School;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$case = 0;

		$schools = School::get();

		$it = 0;

		foreach($schools as $school) {
			if ($it > 1) {
				return;
			}

			$managers = Manager::getManagerBySchool($school -> id);

			foreach ($managers as $manager) {
				switch($manager -> type_admin) {
					case "director":
						$this -> createSchoolEvent($school -> id, $manager -> person, "08/09/2021", "Inicio de curso", "Será el primer día de clase para los alumnos.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "20/06/2022", "Fin de curso", "Será el último día de clase para los alumnos.", "8");

						break;

					case "subdirector":
						$this -> createSchoolEvent($school -> id, $manager -> person, "29/10/2021", "Halloween", "Con motivo del día de Halloween, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "22/12/2021", "Navidad", "Dada la prximidad de la Navidad, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "28/01/2022", "Día de la paz", "Se celebrará el día de la paz.", "2");
						$this -> createSchoolEvent($school -> id, $manager -> person, "14/02/2022", "San valentín", "Con motivo del día de San valentín, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "25/02/2022", "Carnaval", "Con motivo de la celebración de carnavales, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "08/04/2022", "Semana Santa", "Dada la prximidad de la Semana Santa, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "23/04/2022", "Día del libro", "Con motivo del día del libro, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "29/04/2022", "Día de la madre", "Con motivo del día de la madre, se realizarán actividades acordes.", "8");
						$this -> createSchoolEvent($school -> id, $manager -> person, "15/05/2022", "Día de la familia", "Con motivo del día de la familia, se realizarán actividades acordes.", "8");

						break;

					case "psychopedagogue":
						if ($case == 0) {
							$this -> createSchoolEvent($school -> id, $manager -> person, "10/09/2021", "Primer concilio con los padres", "Se trata de convocar a los padres de los alumnos del centro para dar una charla pedagógica.", "2");
							$this -> createSchoolEvent($school -> id, $manager -> person, "29/04/2022", "Tercerer concilio con los padres", "Se trata de convocar a los padres de los alumnos del centro para dar una charla pedagógica.", "2");
							$this -> createSchoolEvent($school -> id, $manager -> person, "03/12/2021", "Reunión con la AMPA", "Reunión con la asociación de madres y padres de los alumnos.", "2");
						} else {
							$this -> createSchoolEvent($school -> id, $manager -> person, "10/12/2021", "Segundo concilio con los padres", "Se trata de convocar a los padres de los alumnos del centro para dar una charla pedagógica.", "2");
							$this -> createSchoolEvent($school -> id, $manager -> person, "13/05/2022", "Reunión con la AMPA", "Otra reunión con la asociación de madres y padres de los alumnos.", "2");
							$this -> createSchoolEvent($school -> id, $manager -> person, "01/06/2022", "Jornada reflexiva del curso", "Charla sobre los aspecto a mejorar de los tutores de los alumnos para afrontar el próximo curso.", "2");
						}

						break;
				}

				$case++;
			}
			
			$preceptors = GroupHavePreceptor::get();

			foreach($preceptors as $preceptor) {
				$this -> createSchoolEvent($school -> id, $preceptor -> preceptor, "12/11/2021", "Excursión a Granada.", "Excursión educativa a la cuidad de Granada.", "20");
				$this -> createSchoolEvent($school -> id, $preceptor -> preceptor, "04/04/2022", "Excursión a Madrid.", "Excursión educativa a la cuidad de Madrid.", "20");
				$this -> createSchoolEvent($school -> id, $preceptor -> preceptor, "20/05/2022", "Excursión a Valencia.", "Excursión educativa a la cuidad de Valencia.", "20");
			}

			$it++;
		}
	}

	private function createSchoolEvent($school, $person, $date, $name, $description, $duration) {
		$event = new Event([
			'school' => $school,
			'date' => $date,
			'responsable' => $person,
			'name' => $name,
			'description' => $description,
			'duration' => $duration
		]);

		$event -> save();
	}
}
