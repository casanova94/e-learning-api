<?php

use Illuminate\Http\Request;

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

Route::apiResource("courses","CoursesController");
Route::apiResource("lessons","LessonsController");
Route::apiResource("questions","QuestionsController");
Route::apiResource("users","UsersController");
Route::apiResource("answers","AnswersController");
Route::apiResource("user-courses","UserCoursesController");
Route::apiResource("user-courses-log","UserCoursesLogController");
Route::apiResource("user-answers-log","UserAnswersLogController");
Route::apiResource("list-courses","ListCoursesController");
Route::apiResource("lessons-for-course","LessonsForCourseController");
Route::apiResource("save-all-answers","SaveAllAnswersController");
Route::apiResource("lesson-details","LessonDetailsController");