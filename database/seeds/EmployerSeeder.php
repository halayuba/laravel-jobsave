<?php

use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into employers (id, name, address, email, phone, website, linkedin, is_archived, industry_id, user_id, `created_at`, `updated_at`) values
           (4,	'Ascend Learning', 'Leawood, KS',	NULL,	NULL,	'http://www.ascendlearning.com/careers/',	NULL,	0,	2,	1,	'2017-10-04 03:21:37',	'2017-10-04 03:21:37'),
            (9,	'VML', 'Kansas City',	NULL,	NULL,	'http://www.vml.com',	NULL,	0,	8,	1,	'2017-10-12 20:10:23',	'2017-10-12 20:10:23'),
            (10, 'SAIC', 'Kansas City',	NULL,	NULL,	'https://www.saic.com/',	'https://www.linkedin.com/company/1614/life/',	0,	8,	1,	'2017-10-18 16:50:29',	'2017-10-18 16:50:29'),
            (11, 'Sprint', 'Overland Park, KS',	NULL,	NULL,	'https://www.sprint.com/en/home.html',	'https://www.linkedin.com/company/1106/life/?lipi=urn%3Ali%3Apage%3Ad_flagship3_job_details%3BRNFtJupyQ4anWNmBzX%2FViw%3D%3D&licu=urn%3Ali%3Acontrol%3Ad_flagship3_job_details-company_link',	0,	10,	1,	'2017-10-18 17:16:40',	'2017-10-18 17:16:40'),
            (12, 'Convergenz', 'Overland Park, KS',	NULL,	NULL,	'http://www.conv.com',	NULL,	0,	18,	1,	'2017-10-18 23:25:43',	'2017-10-18 23:25:43'),
            (13, 'Cybercoders', 'Overland Park, KS USA',	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-10-19 08:46:20',	'2017-10-19 08:46:20'),
            (14, 'ABC production', 'no where street',	'sooooooooooooooomethingLoooooooong@email.com',	'(21)   222 ---455',	'http://www.sooooooooooooooomethingLoooooooong.com/',	NULL,	1,	18,	1,	'2017-10-22 14:54:03',	'2017-11-18 18:11:26'),
            (16, 'xyz production', 'Tokyo',	'simon_bashir@yahoo.com',	NULL,	NULL,	NULL,	1,	5,	1,	'2017-11-10 11:10:31',	'2017-11-19 22:14:33'),
            (17, 'Keypath Education', '15500 W. 113th St., Suite 200\r\nLenexa, KS 66219',	NULL,	'913.254.6000',	'http://keypathedu.com',	'https://www.linkedin.com/company/keypath-education/',	0,	2,	1,	'2017-11-19 16:02:07',	'2017-11-19 16:02:07'),
            (18, '2A Marketing', '419 Main Street Dr\r\nBelton, MO 64012',	'info@2amarketing.com',	'(816) 318-8898',	'https://2amarketing.com/',	NULL,	0,	8,	1,	'2017-11-19 17:59:40',	'2017-11-19 17:59:40'),
            (19, 'TEK Systems', NULL,	'cpetrali@teksystems.com',	'913.982.5015',	'http://teksystems.com',	NULL,	0,	18,	1,	'2017-11-19 18:16:45',	'2017-11-19 18:16:45'),
            (20, 'Lancesoft Inc,', NULL,	'VineetJ@LanceSoft.com',	'(703) 889-6587',	'http://www.LanceSoft.com',	NULL,	0,	18,	1,	'2017-11-19 19:09:12',	'2017-11-19 19:09:12'),
            (21, 'fantastic', NULL,	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-11-23 14:34:53',	'2017-11-23 14:34:53'),
            (22, 'Pendo Management Group', 'Lees Summit, MO 64063',	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-11-27 00:39:23',	'2017-11-27 00:39:23'),
            (23, 'ReachMobi', 'Kansas City, MO',	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-11-27 00:54:18',	'2017-11-27 00:54:18'),
            (24, 'Horizontal Integration', 'Overland Park, KS',	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-11-27 01:02:20',	'2017-11-27 01:02:20'),
            (25, 'Career Transitions', 'Omaha, NE',	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-11-27 01:12:07',	'2017-11-27 01:12:07'),
            (26, 'GEHA', 'If you are interested in another opening, please apply for it directly by logging on to our Applicant Self Service website by clicking here.  Your Login ID is your email address,simon_bashir@yahoo.com, and your password is SBASHIR21. If you forget your login information, please visit the Applicant Self Service page to receive it via email.',	NULL,	NULL,	NULL,	NULL,	0,	5,	1,	'2017-12-07 22:42:25',	'2017-12-07 22:42:25'),
            (27, 'TriCom Technical Services', 'Lenexa, KS',	NULL,	NULL,	NULL,	NULL,	0,	18,	1,	'2017-12-07 23:00:09',	'2017-12-07 23:00:09'),
            (28, 'aware3',	'Kansas City, MO 64106',	NULL,	NULL,	'https://aware3.com/',	NULL,	0,	8,	1,	'2017-12-07 23:10:13',	'2017-12-07 23:10:13'),
            (29, 'Engage Mobile', 'Leawood, Kansas',	NULL,	NULL,	'http://www.engagemobile.com',	'https://www.linkedin.com/jobs/view/483949888/',	0,	8,	1,	'2017-12-18 15:41:23',	'2017-12-18 15:41:23'),
            (30, 'InfuSystem', 'Lenexa, Kansas',	NULL,	NULL,	NULL,	NULL,	0,	8,	1,	'2017-12-18 15:53:35',	'2017-12-18 15:53:35')
         ");
    }
}
