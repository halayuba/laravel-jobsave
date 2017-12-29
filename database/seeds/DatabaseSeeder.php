<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LookupTablesSeeder::class);
        $this->call(ResumeSeeder::class);
        $this->call(EmployerSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(ApplicationSeeder::class);
        $this->call(InterviewSeeder::class);
        $this->call(OfferSeeder::class);
    }
}
