<?php

use Illuminate\Database\Seeder;

class InterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into interviews (`id`, `date`, `time`, `interviewer`, `notes`, `is_canceled`, `is_unsuccessful`, `job_id`, `interview_type_id`, `user_id`, `created_at`, `updated_at`) values
        (3,	'2017-10-23',	'12:00:00',	'so many',	'this was the first interview and went very well. They will inform me about an upcoming interview in the next few days',	1,	0,	26,	2,	1,	'2017-10-24 23:36:05',	'2017-11-05 14:29:36'),
        (4,	'2017-11-29',	'01:00:00',	NULL,	NULL,	1,	0,	26,	2,	1,	'2017-10-25 16:46:49',	'2017-11-05 14:29:36'),
        (5,	'2017-11-15',	'00:12:00',	NULL,	NULL,	1,	0,	28,	2,	1,	'2017-11-11 22:26:04',	'2017-11-19 22:14:33'),
        (6,	'2017-11-10',	'00:12:00',	NULL,	NULL,	1,	0,	29,	2,	1,	'2017-11-11 23:13:54',	'2017-11-19 22:14:34'),
        (7,	'2017-11-23',	'01:00:00',	NULL,	NULL,	0,	0,	35,	2,	1,	'2017-11-23 14:38:16',	'2017-11-23 14:38:16'),
        (8,	'2017-12-21',	'10:30:00',	'Doug Burris',	NULL,	0,	0,	44,	1,	1,	'2017-12-26 14:27:39',	'2017-12-26 14:27:39')
         ");
    }
}
