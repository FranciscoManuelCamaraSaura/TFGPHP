<?php

use App\Http\Controllers\AlertController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupHavePreceptorController;
use App\Http\Controllers\ImpartController;
use App\Http\Controllers\LegalGuardianController;
use App\Http\Controllers\MakesController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//	return $request->user();
//});

// Schools routes
Route::get('/school', [SchoolController::class, 'index']);
Route::get('/school/{id}', [SchoolController::class, 'show']);

// Courses routes
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'show']);

// Groups routes
Route::get('/groups', [GroupController::class, 'index']);
Route::get('/group', [GroupController::class, 'show']);

// Person routes
Route::get('/person/{dni}', [PersonController::class, 'show']);
Route::put('/person', [PersonController::class, 'update']);

// Student routes
Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{legal_guardian}', [StudentController::class, 'showApi']);

// Impart routes
Route::get('/impart', [ImpartController::class, 'showApi']);

// Group have Preceptor routes
Route::get('/groupHavePreceptor', [GroupHavePreceptorController::class, 'show']);

// Subjects routes
Route::post('/subjects', [SubjectController::class, 'showApi']);

// Teachers routes
Route::post('/teachers', [TeacherController::class, 'showApi']);

// Managers routes
Route::get('/managers/{school_id}', [ManagerController::class, 'index']);
Route::post('/managers', [ManagerController::class, 'show']);

// Legal Guardian routes
Route::post('/legal_guardian', [LegalGuardianController::class, 'login']);
Route::put('/legal_guardian', [LegalGuardianController::class, 'update']);

// Messages routes
Route::get('/messageSent/{sender}', [MessageController::class, 'showSenderApi']);
Route::get('/messageReceived/{receiver}', [MessageController::class, 'showReceiverApi']);
Route::post('/messageRead', [MessageController::class, 'updateRead']);
Route::post('/messageReply', [MessageController::class, 'updateReply']);
Route::post('/messageUpdate', [MessageController::class, 'updateData']);
Route::put('/messageSender', [MessageController::class, 'insertSenderApi']);
// Route::put('/messageReceiver', [MessageController::class, 'insertReceiverApi']);

// Alerts routes
Route::get('/alertReceived/{receiver}', [AlertController::class, 'showApi']);
Route::post('/alertRead', [AlertController::class, 'updateRead']);

// Events routes
Route::get('/events', [EventController::class, 'showApi']);

// Exams routes
Route::get('/exams', [ExamController::class, 'show']);

// Makes routes
Route::get('/makes', [MakesController::class, 'show']);
