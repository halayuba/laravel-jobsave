<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsaveTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('users', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name');
           $table->string('email')->unique();
           $table->string('password');
           $table->boolean('is_active')->default(false);
           $table->string('activation_token')->nullable();
           $table->rememberToken();
           $table->timestamps();
       });
       Schema::create('password_resets', function (Blueprint $table) {
           $table->string('email')->index();
           $table->string('token');
           $table->timestamp('created_at')->nullable();
       });
       Schema::create('resumes', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title', 55)->unique();
           $table->string('file', 95)->nullable();
           $table->string('folder', 75)->nullable(); //FORLDER LOCATION WHERE RESUME IS STORED
           $table->date('last_update')->nullable();
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->timestamps();
       });
       Schema::create('industries', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name', 55)->unique();
       });
       Schema::create('employers', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name', 55);
           $table->text('address')->nullable();
           $table->string('email')->nullable();
           $table->string('phone', 20)->nullable();
           $table->string('website')->nullable();
           $table->string('linkedin')->nullable();
           $table->boolean('is_archived')->default(0);
           $table->integer('industry_id')->unsigned()->default(1);
           $table->foreign('industry_id')->references('id')->on('industries');
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->timestamps();
       });
       Schema::create('employment_types', function (Blueprint $table) {
           $table->increments('id');
           $table->string('type', 55)->unique();
       });
       Schema::create('venues', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name', 55)->unique();
       });
       Schema::create('job_roles', function (Blueprint $table) {
           $table->increments('id');
           $table->string('name', 55)->unique();
       });
       Schema::create('jobs', function (Blueprint $table) {
           $table->increments('id');
           $table->string('identifier', 55);
           $table->string('title', 75);
           $table->date('date_posted')->nullable();
           $table->text('description')->nullable();
           $table->string('url')->nullable();
           $table->text('location');
           $table->string('posted_by', 75)->nullable();
           $table->string('file')->nullable(); //JOB DESCRIPTION BUT CAPTURED AS IMAGE
           $table->string('seniority_level', 155)->nullable();
           $table->string('compensation')->nullable();
           $table->boolean('is_bookmarked')->default(0); //REFERS TO A JOB THAT YOU WOULD LIKE TO PURSUE SOON OR ONE THAT YOU ARE FOCUSED ON
           $table->boolean('has_submitted')->default(0); //JOBS THAT AN APPLICATION HAS BEEN SUBMITTED TO
           $table->boolean('has_closed')->default(0); //JOBS THAT IS NO LONGER OPEN OR HAS BEEN ARCHIVED
           $table->integer('venue_id')->unsigned();
           $table->foreign('venue_id')->references('id')->on('venues');
           $table->integer('employment_type_id')->unsigned();
           $table->foreign('employment_type_id')->references('id')->on('employment_types');
           $table->integer('employer_id')->unsigned();
           $table->foreign('employer_id')->references('id')->on('employers');
           $table->integer('job_role_id')->unsigned()->default(1);
           $table->foreign('job_role_id')->references('id')->on('job_roles');
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->timestamps();
       });
       Schema::create('applications', function (Blueprint $table) {
           $table->increments('id');
           $table->date('submitted_on');
           $table->text('notes')->nullable();
           $table->boolean('has_submitted')->default(1); //SOMETIMES A SUBMISSION IS NOT FULLY COMPLETED AND MAY REQUIRE ADDITIONAL WORK
           $table->boolean('has_turned_down')->default(0);
           $table->integer('resume_id')->unsigned();
           $table->foreign('resume_id')->references('id')->on('resumes');
           $table->integer('job_id')->unsigned();
           $table->foreign('job_id')->references('id')->on('jobs');
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->timestamps();
       });
       Schema::create('interview_types', function (Blueprint $table) {
           $table->increments('id');
           $table->string('type', 55)->unique();
       });
       Schema::create('interviews', function (Blueprint $table) {
           $table->increments('id');
           $table->date('date');
           $table->time('time');
           $table->string('interviewer', 255)->nullable();
           $table->text('notes')->nullable();
           $table->boolean('is_canceled')->default(false); // INTERVIEW THAT HAS BEEN CANCELED
           $table->boolean('is_unsuccessful')->default(0); // INTERVIEW WAS NOT SUCCESSFUL OR DETERMINED NOT A GOOD FIT
           $table->integer('job_id')->unsigned();
           $table->foreign('job_id')->references('id')->on('jobs');
           $table->integer('interview_type_id')->unsigned();
           $table->foreign('interview_type_id')->references('id')->on('interview_types');
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->timestamps();
       });
       Schema::create('offers', function (Blueprint $table) {
           $table->increments('id');
           $table->date('date');
           $table->string('amount', 100)->nullable();
           $table->text('details')->nullable();
           $table->text('notes')->nullable(); //E.G., START DATE
           $table->boolean('is_accepted')->nullable();
           $table->boolean('is_archived')->default(0);
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->integer('job_id')->unsigned();
           $table->foreign('job_id')->references('id')->on('jobs');
           $table->timestamps();
       });
       Schema::create('uploads', function (Blueprint $table) {
           $table->increments('id');
           $table->string('file_name', 95);
           $table->boolean('is_image')->default(1);
           $table->string('extension', 5);
           $table->string('size', 55);
           $table->smallInteger('width')->nullable();
           $table->smallInteger('height')->nullable();
           $table->integer('uploadable_id')->unsigned();
           $table->string('uploadable_type');
           $table->timestamps();
       });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('offers');
      Schema::dropIfExists('uploads');
      Schema::dropIfExists('applications');
      Schema::dropIfExists('interviews');
      Schema::dropIfExists('interview_types');
      Schema::dropIfExists('jobs');
      Schema::dropIfExists('employment_types');
      Schema::dropIfExists('job_roles');
      Schema::dropIfExists('venues');
      Schema::dropIfExists('employers');
      Schema::dropIfExists('industries');
      Schema::dropIfExists('resumes');
      Schema::dropIfExists('users');
      Schema::dropIfExists('password_resets');
    }
}
