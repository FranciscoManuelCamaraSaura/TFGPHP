<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Group;
use App\Models\Impart;
use App\Models\LegalGuardian;
use App\Models\Manager;
use App\Models\Message;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//DB::table('message') -> delete();
		$case = 0;

		$schools = School::get();

		$it = 0;

		foreach($schools as $school) {
			if ($it > 1) {
				return;
			}

			$courses = Course::getCourses($school -> id);
			$managers = Manager::getManagerBySchool($school -> id);

			foreach($courses as $course) {
				$groups = Group::getGroups($course -> id);

				foreach($groups as $group) {
					$imparts = Impart::getByCourseGroup($group -> course_id, $group -> group_words);
					$students = Student::getGroup($group -> course_id, $group -> group_words);

					foreach($imparts as $impart) {
						$teacher = Teacher::getDNIPerson($impart -> teacher);

						foreach ($students as $student) {
							foreach ($managers as $manager) {
								$send = count(Message::getSender($manager -> person));
								$receiver = count(Message::getReceiver($manager -> person));
	
								if($send < 25 && $receiver < 25) {
									$this -> getCase($case, $student -> legal_guardian, $manager -> person);
								}
							}

							$send = count(Message::getSender($teacher -> person));
							$receiver = count(Message::getReceiver($teacher -> person));

							if($send < 25 && $receiver < 25) {
								$this -> getCase($case, $student -> legal_guardian, $teacher -> person);
							}

							$case++;
						}
					}
				}
			}

			$it++;
		}
	}

	private function getCase($case, $sender, $receiver) {
		if ($case % 2 == 0) {
			$previousMessage = $this -> sentMessagesWithOutPrevius($sender, $receiver);
			$previousMessage = $this -> recivedMessages($sender, $receiver, $previousMessage);
			$this -> sentMessagesWithPrevius($sender, $receiver, $previousMessage);
		} else if ($case % 3 == 0) {
			$previousMessage = $this -> sentMessagesWithOutPrevius($sender, $receiver);
			$previousMessage = $this -> recivedMessages($sender, $receiver, $previousMessage);
			$this -> recivedMessagesNotReply($sender, $receiver, $previousMessage);
		}
	}

	public function sentMessagesWithOutPrevius($sender, $receiver) {
		$messageToReply = new Message([
			'date' => "06/02/2020 10:05:34",
			'matter' => "Primer mensaje",
			'text' => "Esto es un mensaje de un seeder enviado por uno de los tutores legales a un profesor que imparte una asignatura en segundo de bachiller.",
			'sender' => $sender,
			'receiver' => $receiver,
			'read' => true,
			'reply' => true
		]);

		$messageToReply -> save();

		$message = new Message([
			'date' => "06/02/2020 11:05:34",
			'matter' => "Segundo mensaje",
			'text' => "Esto es un mensaje de un seeder enviado por el mismo tutor legal a un profesor de otra asignatura en segundo de bachiller.",
			'sender' => $sender,
			'receiver' => $receiver,
			'read' => true,
			'reply' => false
		]);

		$message -> save();

		return $messageToReply;
	}

	public function recivedMessages($sender, $receiver, $previousMessage) {
		$message = new Message([
			'date' => "06/02/2020 12:50:34",
			'matter' => "Tercer mensaje",
			'text' => "Esto es un mensaje de un seeder enviado por un profesor que imparte una asignatura en segundo de bachiller en respuesta a un tutor legal",
			'sender' => $receiver,
			'receiver' => $sender,
			'previous_message' => $previousMessage -> id,
			'read' => true,
			'reply' => true
		]);

		$message -> save();

		return $message;
	}

	public function recivedMessagesNotReply($sender, $receiver) {
		$message = new Message([
			'date' => "06/02/2020 12:50:34",
			'matter' => "Tercer mensaje",
			'text' => "Esto es un mensaje de un seeder enviado por un profesor que imparte una asignatura en segundo de bachiller en respuesta a un tutor legal",
			'sender' => $receiver,
			'receiver' => $sender,
			'read' => true,
			'reply' => false
		]);

		$message -> save();

		return $message;
	}

	public function sentMessagesWithPrevius($sender, $receiver, $previousMessage) {
		$message = new Message([
			'date' => "06/02/2020 13:30:00",
			'matter' => "Cuarto mensaje",
			'text' => "Esto es un mensaje de un seeder enviado por uno de los tutores legales a un profesor que imparte una asignatura en segundo de bachiller.",
			'sender' => $sender,
			'receiver' => $receiver,
			'previous_message' => $previousMessage -> id,
			'read' => false,
			'reply' => false
		]);

		$message -> save();
	}
}
