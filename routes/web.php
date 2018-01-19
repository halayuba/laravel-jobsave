<?php

Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');
Route::view('dashboard', 'pages.dashboard');

Auth::routes();

 //== ACCOUNT ACTIVATION
//====================
Route::get('/auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');
Route::get('/auth/activation/resend', 'Auth\ActivationController@activation_resend_form')->name('auth.activation.resend');
Route::post('/auth/activation/resend', 'Auth\ActivationController@activation_resend');

 //== DEDICATED RESOURCES
//====================
Route::group(['middleware'=>'auth'], function(){

   //== OVERVIEW
 //====================
 Route::group(['prefix'=>'overview'], function(){
   Route::get('/', 'OverviewController@overview')->name('overview');
   Route::get('/upcoming-interviews', 'OverviewController@upcoming')->name('overview.upcoming-interviews');
   Route::get('/old-interviews', 'OverviewController@old')->name('overview.old-interviews');
   Route::get('/no-success', 'OverviewController@noSuccess')->name('overview.no-success');
 });

   //== RESUMES
 //====================
 Route::group(['prefix'=>'resumes'], function(){
   Route::get('/', 'ResumeController@index')->name('resumes.index');
   Route::get('create', 'ResumeController@create')->name('resumes.create');
   Route::post('/', 'ResumeController@store')->name('resumes.store');
   Route::get('/{resume}/edit', 'ResumeController@edit')->name('resumes.edit');
   Route::patch('/{resume}', 'ResumeController@update')->name('resumes.update');
   Route::delete('/{resume}', 'ResumeController@destroy')->name('resumes.destroy');
   Route::get('/{resume}/download', 'ResumeController@download')->name('resumes.download');
 });

   //== EMPLOYERS
 //====================
 Route::group(['prefix'=>'employers'], function(){
   Route::get('/', 'EmployerController@index')->name('employers.index');
   Route::get('create', 'EmployerController@create')->name('employers.create');
   Route::post('/', 'EmployerController@store')->name('employers.store');
   Route::get('/{employer}', 'EmployerController@show')->name('employers.show');
   Route::get('/{employer}/edit', 'EmployerController@edit')->name('employers.edit');
   Route::get('/{employer}/status-update', 'EmployerController@statusUpdate')->name('employers.statusUpdate');
   Route::patch('/{employer}', 'EmployerController@update')->name('employers.update');
   Route::delete('/{employer}', 'EmployerController@destroy')->name('employers.destroy');
 });

   //== JOBS
 //====================
 Route::group(['prefix'=>'jobs'], function(){
   Route::get('/', 'JobController@index')->name('jobs.index');
   Route::get('create', 'JobController@create')->name('jobs.create');
   Route::get('create-specific/{id}', 'JobController@createSpecific')->name('jobs.createSpecific');
   Route::post('/', 'JobController@store')->name('jobs.store');
   Route::get('/{job}', 'JobController@show')->name('jobs.show');
   Route::get('/{job}/edit', 'JobController@edit')->name('jobs.edit');
   Route::get('/{job}/status-update', 'JobController@statusUpdate')->name('jobs.statusUpdate');
   Route::patch('/{job}', 'JobController@update')->name('jobs.update');
   Route::delete('/{job}', 'JobController@destroy')->name('jobs.destroy');
   Route::get('/{job}/download', 'JobController@download')->name('jobs.download');
   Route::get('/employers/{employer}', 'JobController@indexByEmployer')->name('jobs.indexByEmployer');
 });

   //== APPLICATIONS
 //====================
 Route::group(['prefix'=>'applications'], function(){
    Route::get('/', 'ApplicationController@index');
    Route::get('/job-openings', 'ApplicationController@jobList');
    Route::get('/create/{job}', 'ApplicationController@create')->name('applications.create');
    Route::post('/job/{job}', 'ApplicationController@store')->name('applications.store');
    Route::get('/job/{job}', 'ApplicationController@show')->name('applications.show');
    Route::get('/{application}/edit', 'ApplicationController@edit')->name('applications.edit');
    Route::get('/{application}', 'ApplicationController@statusUpdate')->name('applications.statusUpdate');
    Route::patch('/{application}', 'ApplicationController@update')->name('applications.update');
    Route::delete('/{application}', 'ApplicationController@destroy')->name('applications.destroy');
    Route::get('/modal/{application}', 'ApplicationController@modal');
 });

  //== INTERVIEWS
//====================
  Route::group(['prefix'=>'interviews'], function(){
    Route::get('/', 'InterviewController@index');
    Route::get('/jobs-submitted', 'InterviewController@jobList')->name('interviews.jobList');
    Route::get('/jobs/{job}', 'InterviewController@create')->name('interviews.create');
    Route::post('/jobs/{job}', 'InterviewController@store')->name('interviews.store');
    Route::get('/{interview}/jobs/{job}', 'InterviewController@show')->name('interviews.show');
    Route::get('/{interview}/edit', 'InterviewController@edit')->name('interviews.edit');
    Route::get('/{interview}/cancel', 'InterviewController@statusUpdateCanceled')->name('interviews.statusUpdateCanceled');
    Route::get('/{interview}/unsuccessful', 'InterviewController@statusUpdateUnsuccessful')->name('interviews.statusUpdateUnsuccessful');
    Route::patch('/{interview}', 'InterviewController@update')->name('interviews.update');
    Route::delete('/{interview}', 'InterviewController@destroy')->name('interviews.destroy');
  });

  //== OFFERS
//====================
  Route::group(['prefix'=>'offers'], function(){
    Route::get('/', 'OfferController@index');
    Route::get('/interview-list', 'OfferController@interviewList')->name('offers.interviewList');
    Route::get('/jobs/{job}', 'OfferController@create')->name('offers.create');
    Route::post('/jobs/{job}', 'OfferController@store')->name('offers.store');
    Route::get('/{offer}/jobs/{job}', 'OfferController@show')->name('offers.show');
    Route::get('/{offer}/edit', 'OfferController@edit')->name('offers.edit');
    Route::get('/{offer}/accept', 'OfferController@statusUpdateAccept')->name('offers.statusUpdateAccept');
    Route::get('/{offer}/decline', 'OfferController@statusUpdateDecline')->name('offers.statusUpdateDecline');
    Route::patch('/{offer}', 'OfferController@update')->name('offers.update');
    Route::delete('/{offer}', 'OfferController@destroy')->name('offers.destroy');
  });


});
