<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupHavePreceptorController;
use App\Http\Controllers\ImpartController;
use App\Http\Controllers\LegalGuardianController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//	return view('welcome');
//});

Route::get('/', function () {
	$school = "";
	$person = "";
	$type_user = "";
	$message = "Welcome";

	return view('home', compact("school", "person", "type_user", "message"));
});

Route::get('/prelogin', [SchoolController::class, 'provinces']);
Route::get('/school/{id}', [SchoolController::class, 'school']);
Route::get('/login/{id}', [SchoolController::class, 'prelogin']);
Route::post('/locations', [SchoolController::class, 'locations']);
Route::post('/schools', [SchoolController::class, 'schools']);
Route::post('/identify', [SchoolController::class, 'login']);

Route::get('/contact', function () {
	$school = "";
	$person = "";
	$type_user = "";
	$message = "";

	return view('contact', compact("school", "person", "type_user", "message"));
});

Route::get('/home/{id}/admin/{admin}', [ManagerController::class, 'login']);
Route::get('/home/{id}/manager/{manager}', [ManagerController::class, 'login']);
Route::get('/home/{id}/teacher/{teacher}', [TeacherController::class, 'login']);

Route::get('/perfil/{id}/person/{person}/type/{type_user}', [PersonController::class, 'profile']);
Route::put('/person', [PersonController::class, 'update']);
Route::put('/newPerson', [PersonController::class, 'insert']);
Route::put('/updatePerson', [PersonController::class, 'update']);
Route::put('/password/teacher', [TeacherController::class, 'update']);
Route::put('/password/manager', [ManagerController::class, 'update']);

Route::post('/group', [GroupController::class, 'showGroups']);

Route::get('/subjects/{id}/person/{person}', [SubjectController::class, 'showWeb']);
Route::get('/subjects/{id}/person/{person}/subject/{code}', [SubjectController::class, 'showSubject']);
Route::post('/subjects', [SubjectController::class, 'showSubjects']);

Route::get('/students/{id}/person/{person}/student/{student}', [StudentController::class, 'showWeb']);
Route::get('/students/{id}/person/{person}', [StudentController::class, 'showStudents']);
Route::get('/students/{id}/person/{person}/newStudent', [StudentController::class, 'newStudent']);
Route::get('/students/{id}/person/{person}/editStudent/{student}', [StudentController::class, 'editStudent']);
Route::post('/evaluations', [StudentController::class, 'showEvaluations']);
Route::put('/newLegalGuardian', [LegalGuardianController::class, 'insert']);
Route::put('/saveStudent', [StudentController::class, 'insert']);
Route::put('/updateStudent', [StudentController::class, 'update']);
Route::put('/deleteStudent', [StudentController::class, 'delete']);

Route::get('/messages/{id}/person/{person}', [MessageController::class, 'messages']);
Route::get('/messages/{id}/person/{person}/newMessage', [MessageController::class, 'newMessage']);
Route::get('/messages/{id}/person/{person}/previewMessage', [MessageController::class, 'previewMessage']);
Route::get('/messages/{id}/messagesSent/{sender}', [MessageController::class, 'showSenderWeb']);
Route::get('/messages/{id}/messagesReceived/{receiver}', [MessageController::class, 'showReceiverWeb']);
Route::get('/messages/{id}/person/{person}/getMessage/{message}', [MessageController::class, 'getMessage']);
Route::post('/students', [MessageController::class, 'students']);
Route::post('/newMessages', [MessageController::class, 'checkNewMessages']);
Route::put('/messageSender', [MessageController::class, 'insertSenderWeb']);

Route::get('/events/{id}/person/{person}', [EventController::class, 'showWeb']);
Route::get('/events/{id}/person/{person}/calendar', [EventController::class, 'calendar']);
Route::get('/events/{id}/person/{person}/addEvent', [EventController::class, 'insert']);
Route::get('/events/{id}/person/{person}/editEvents', [EventController::class, 'listEvents']);
Route::get('/events/{id}/person/{person}/editEvent', [EventController::class, 'update']);
Route::post('/checkEvents', [EventController::class, 'checkEvents']);
Route::put('/newEvent', [EventController::class, 'insertEvent']);
Route::put('/editEvent', [EventController::class, 'updateEvent']);
Route::put('/deleteEvent', [EventController::class, 'delete']);

Route::get('/exams/{id}/person/{person}/evalueExam/{exam}', [ExamController::class, 'evaluate']);
Route::put('/newExam', [ExamController::class, 'insert']);
Route::put('/editExam', [ExamController::class, 'update']);
Route::put('/evaluateExam', [ExamController::class, 'makeEvaluation']);
Route::put('/deleteExam', [ExamController::class, 'delete']);

Route::get('/alerts/{id}/person/{person}', [AlertController::class, 'showWeb']);
Route::post('/readAlerts', [AlertController::class, 'checkAlerts']);
Route::put('/sendAlert', [AlertController::class, 'insert']);
Route::put('/deleteAlert', [AlertController::class, 'delete']);

Route::get('/teachers/{id}/person/{person}', [TeacherController::class, 'showWeb']);
Route::get('/teachers/{id}/person/{person}/teacher/{teacher}', [TeacherController::class, 'showTeacher']);
Route::get('/teachers/{id}/person/{person}/newTeacher', [TeacherController::class, 'newTeacher']);
Route::get('/teachers/{id}/person/{person}/editTeacher/{teacher}', [TeacherController::class, 'editTeacher']);
Route::post('/teaching', [TeacherController::class, 'showTeachers']);
Route::put('/addTeacher', [TeacherController::class, 'insert']);
Route::put('/updateTeacher', [TeacherController::class, 'update']);
Route::put('/deleteTeacher', [TeacherController::class, 'delete']);

Route::post('/preceptor', [GroupHavePreceptorController::class, 'show']);
Route::put('/newPreceptor', [GroupHavePreceptorController::class, 'insert']);
Route::put('/updatePreceptor', [GroupHavePreceptorController::class, 'update']);
Route::put('/deletePreceptor', [GroupHavePreceptorController::class, 'delete']);

Route::post('/checkImpart', [ImpartController::class, 'showWeb']);
Route::put('/newImpart', [ImpartController::class, 'insert']);
Route::put('/updateImpart', [ImpartController::class, 'update']);
Route::put('/deleteImpart', [ImpartController::class, 'delete']);

Route::get('/managers/{id}/person/{person}', [ManagerController::class, 'showWeb']);
Route::get('/managers/{id}/person/{person}/newManager', [ManagerController::class, 'newManager']);
Route::get('/managers/{id}/person/{person}/editManager/{manager}', [ManagerController::class, 'editManager']);
Route::post('/validateType', [ManagerController::class, 'validateType']);
Route::put('/addManager', [ManagerController::class, 'insert']);
Route::put('/updateManager', [ManagerController::class, 'update']);
Route::put('/deleteManager', [ManagerController::class, 'delete']);
