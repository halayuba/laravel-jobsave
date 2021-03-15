<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Jobs\{SubmissionController, InterviewController};

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*=====================================
  ||||| JOB SUBMISSIONS |||||
  =====================================*/
Route::apiResource('jobs', SubmissionController::class);

Route::prefix('jobs')->group(function(){
  Route::put('/{job}/unsuccessful', [SubmissionController::class, 'updateToUnsuccessful']);
  Route::post('/{job}/interview', [SubmissionController::class, 'storeInterviewDetail']);
  // Route::post('/{job}/interview', [InterviewController::class, 'store']);
});

Route::prefix('interviews')->group(function(){
  Route::get('/', [InterviewController::class, 'index']);
  Route::put('/{interview}', [InterviewController::class, 'update']);
  Route::put('/{interview}/update-completed', [InterviewController::class, 'updateCompleted']);

});
