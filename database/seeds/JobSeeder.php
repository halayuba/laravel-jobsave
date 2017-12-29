<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into jobs (`id`, `identifier`, `title`, `date_posted`, `description`, `url`, `location`, `posted_by`, `file`, `seniority_level`, `compensation`, `is_bookmarked`, `has_submitted`, `has_closed`, `venue_id`, `employment_type_id`, `employer_id`, `job_role_id`, `user_id`, `created_at`, `updated_at`) values
            (26, '59ecf885eeea5', 'Systems Engineer', '2017-09-21',	NULL, NULL,	'Boston', NULL,	NULL, NULL,	NULL, 0, 1,	1,	3, 1, 14, 1, 1,	'2017-10-22 14:59:01', '2017-11-05 14:29:35'),
            (27, '59ff466c82a0c', 'Accountant',	'2017-11-03', NULL, NULL, 'Baltimore', NULL, NULL, NULL, NULL, 0,	0, 1, 3, 3, 14,	1, 1, '2017-11-05 11:12:12', '2017-11-05 14:29:36'),
            (28, '5a05e6c39aa84', 'Accountant',	'2017-11-10', NULL,	NULL,	'Lincoln, NE',	NULL,	NULL,	NULL,	NULL,	1,	1,	1,	3,	3,	16,	1,	1,	'2017-11-10 11:49:55',	'2017-11-19 22:14:33'),
            (29, '5a07d0ba0d5a6', 'Tanzeef', '2017-10-12', NULL, NULL, 'Imporia, KS', NULL,	NULL, NULL,	NULL, 0, 1,	1,	13,	1,	16,	1,	1,	'2017-11-11 22:40:26',	'2017-11-19 22:14:33'),
            (30, '5a07de3db7036', 'Bareed',	'2017-11-09', NULL,	NULL, 'Dallas, TX', NULL, NULL,	NULL, NULL,	0,	0,	1,	16,	5,	16,	1,	1,	'2017-11-11 23:38:05',	'2017-11-19 22:14:34'),
            (35, '5a173157e58b1', 'fancy job', '2017-11-21', NULL, NULL, 'Seattle, WA', NULL, NULL, NULL, NULL,	0,	1,	0,	16,	1,	21,	1,	1,	'2017-11-23 14:36:39',	'2017-11-23 14:37:49'),
            (40, '5a2a1ad901320', 'Senior Business Analyst', '2017-12-01', NULL, 'https://www.dice.com/jobs/detail/Senior-Business-Analyst-Government-Employees-Health-Association%2C-Inc.-Lee%27s-Summit-MO-64086/RTX13c02b/246159?icid=sr1-1p&q=Business+Analyst&l=64138', 'Lee\'s Summit, MO', NULL, NULL, NULL, NULL,	1,	1,	0,	4,	1,	26,	1,	1,	'2017-12-07 22:53:45',	'2017-12-07 22:56:24'),
            (41, '5a2a1cf2d8ec9', 'Business Analyst', '2017-12-04', NULL, 'https://www.dice.com/jobs/detail/Business-Analyst-TriCom-Technical-Services-Lenexa-KS-66219/tricom/6286?icid=sr5-1p&q=Business+Analyst&l=64138#', 'KC', NULL, NULL, NULL, NULL, 0, 1, 0,	4, 1, 27, 1, 1, '2017-12-07 23:02:42', '2017-12-07 23:03:01'),
            (42, '5a2a1f7151e26', 'Senior Web Developer', '2017-12-06', NULL, 'https://www.ziprecruiter.com/jobs/aware3-69f3dce7/senior-web-developer-3a133f4b?mid=5&source=email-candidate-job-alert&contact_id=080ab409&auth_token=_v3_22ff5f5fbd0a47cd48ec5699010e05a2cb0f9f0f3094f5e4a6e798a181325de0&expires=1512821831', 'KC', NULL, NULL, NULL, NULL, 0,	1, 0, 16, 1, 28, 1,	1, '2017-12-07 23:13:21', '2017-12-07 23:13:40'),
            (43, '5a2a21679587a', 'Business Systems Analyst', '2017-11-17', NULL, 'https://www.dice.com/jobs/detail/10117305/224131#', 'Overland Park, KS',	NULL, NULL,	NULL, NULL,	0, 1, 0, 4,	1, 12, 1, 1,	'2017-12-07 23:21:43', '2017-12-07 23:22:05'),
            (44, '5a38366c20f18', 'Business Analyst', '2017-12-11',	NULL, 'https://www.linkedin.com/jobs/view/483949888/', 'Leawood, Kansas', 'Steve Timperley', NULL, 'Mid-Senior level', NULL, 1, 1, 0, 1, 1, 29,	1, 1, '2017-12-18 15:43:08', '2017-12-18 15:43:45'),
            (45, '5a38394557cce', 'Business Analyst', '2017-12-11',	NULL, 'https://www.linkedin.com/jobs/view/508327100/', 'Lenexa, Kansas', NULL, NULL, 'Mid-Senior level', NULL, 0, 1, 0,	1, 1, 30, 1, 1,	'2017-12-18 15:55:17', '2017-12-18 15:55:53');
         ");
    }
}
