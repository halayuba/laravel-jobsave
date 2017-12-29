<?php

use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into resumes (id, title, file, folder, last_update, user_id) values
           (1, 'Global Distribution Director', 'public/resumes/2017/GDP.php', 'boshanab/Documents/Resume/resume_year/2017/PM', '2017-11-15', 1),
           (2, 'Web Development', 'public/resumes/Simon_Bashir_Resume_PHP.pdf', '/boshanab/Documents/Resume/resume_year/2017', '2017-08-19', 1)
         ");
    }
}