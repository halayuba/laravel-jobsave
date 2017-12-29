<?php

use Illuminate\Database\Seeder;

use App\User;
use Carbon\Carbon;

class LookupTablesSeeder extends Seeder
{
  public function run()
  {
      //EMPLOYMENT TYPES
     //==========
     DB::insert("insert into employment_types (id, type) values
       (1, 'Full-time'),
       (2, 'Contract'),
       (3, 'Contract-to-Hire'),
       (4, 'Part-time'),
       (5, 'Temporary'),
       (6, 'Freelance'),
       (7, 'Remote'),
       (8, 'Internship')
     ");

      //INTERVIEW TYPES
     //==========
     DB::insert("insert into interview_types (id, type) values
       (1, 'Phone'),
       (2, 'in-person'),
       (3, 'via Skype'),
       (4, 'GoToMeeting'),
       (5, 'WebEx'),
       (6, 'Others')
     ");

      //VENUES
     //==========
     DB::insert("insert into venues (id, name) values
       (1, 'Linkedin'),
       (2, 'Indeed'),
       (3, 'CareerBuilder'),
       (4, 'Dice'),
       (5, 'US.jobs'),
       (6, 'Monster'),
       (7, 'Glassdoor'),
       (8, 'SimplyHired'),
       (9, 'LinkUp'),
       (10, 'LaraJobs'),
       (11, 'Company\'s website'),
       (12, 'Staffing Agency'),
       (13, 'Craigslist'),
       (14, 'Cybercoders'),
       (15, 'Others'),
       (16, 'ZipRecruiter'),
       (17, 'Not related to a job posting'),
       (18, 'Received via email')
     ");

      //INDUSTRIES
     //==========
     DB::insert("insert into industries (id, name) values
       (1, ' Not Specified'),
       (2, 'Education / Training'),
       (3, 'Manufacturing'),
       (4, 'Logistics / Cargo / Shipping'),
       (5, 'Pharmaceutical / Healthcare'),
       (6, 'Insurance'),
       (7, 'Financial / Banking'),
       (8, 'Information Technology and Services'),
       (9, 'Retail / Department Store'),
       (10, 'Telecommunications'),
       (11, 'Food / Restaurants'),
       (12, 'General Services'),
       (13, 'Media / Publishing / Broadcasting'),
       (14, 'Mechanical / Industrial Engineering'),
       (15, 'Government / Defense'),
       (16, 'Internet / Online Marketplace'),
       (17, 'Computer Software'),
       (18, 'Staffing / Recruiting'),
       (19, 'Marketing / Advertising'),
       (20, 'Web Design / Development'),
       (21, 'Others')
     ");

      //JOB ROLES
     //==========
     DB::insert("insert into job_roles (id, name) values
       (1, ' Not Listed'),
       (2, 'Technology'),
       (3, 'Executive'),
       (4, 'Administration'),
       (5, 'Management'),
       (6, 'Finance'),
       (7, 'Marketing'),
       (8, 'Sales'),
       (9, 'Billing'),
       (10, 'Human Resource'),
       (11, 'Engineering'),
       (12, 'Others')
     ");

     $admin[] = [
       'id' => 1,
       'name' => 'Admin',
       'email' => 'admin@admin.com',
       'password' => bcrypt('admin'),
       'is_active' => true,
       'remember_token' => str_random(10),
       'created_at' => Carbon::now(),
       'updated_at' => Carbon::now(),
     ];
     DB::table('users')->insert($admin);
  }
}
