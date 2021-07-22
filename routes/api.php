<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Jobs\{SubmissionController, InterviewController};
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

/*=====================================
  ||||| USERS |||||
  =====================================*/
Route::get('/auth/user', [UserController::class, 'index'])->middleware('auth:sanctum');

/*=====================================
  ||||| JOB SUBMISSIONS |||||
  =====================================*/
Route::apiResource('jobs', SubmissionController::class);

Route::prefix('jobs')->group(function () {
  Route::put('/{job}/unsuccessful', [SubmissionController::class, 'updateToUnsuccessful']);
  Route::post('/{job}/interview', [SubmissionController::class, 'storeInterviewDetail']);
});

Route::prefix('interviews')->group(function () {
  Route::get('/', [InterviewController::class, 'index']);
  Route::put('/{interview}', [InterviewController::class, 'update']);
  Route::put('/{interview}/update-completed', [InterviewController::class, 'updateCompleted']);
  Route::delete('/{interview}', [InterviewController::class, 'destroy']);
});
