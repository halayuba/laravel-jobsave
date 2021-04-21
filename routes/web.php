<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{HomeController, NewsletterController};
use App\Http\Controllers\Jobs\{SubmissionController, InterviewController};

Route::redirect('/', '/home');

Route::prefix('home')->group(function(){
  Route::get('/', [HomeController::class, 'index'])->name('home');
});

/*=====================================
  ||||| JOB SUBMISSIONS |||||
  =====================================*/
Route::group(['prefix'=>'jobs'], function(){
  Route::get('/', [SubmissionController::class, 'index'])->name('submissions');
  Route::get('/interviews', [InterviewController::class, 'index'])->name('interviews');
  // Route::get('/offers', [JobOfferController::class, 'index'])->name('offers');
});

 //== NEWSLETTER
//====================
Route::post('/', [NewsletterController::class, 'store'])->name('newsletter');

require __DIR__.'/auth.php';
