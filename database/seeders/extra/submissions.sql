-- Adminer 4.8.1 MySQL 8.0.25-0ubuntu0.20.10.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

TRUNCATE `submissions`;
INSERT INTO `submissions` (`id`, `company`, `location`, `position`, `url`, `note`, `status`, `created_at`, `updated_at`, `user_id`) VALUES
(2,	'Highland',	'Chicago, IL',	'Full Stack Application Developer',	'https://highland.bamboohr.com/jobs/view.php?id=60&source=other',	NULL,	'No Feedback',	'2021-02-19 11:22:26',	'2021-03-02 01:21:39',	1),
(3,	'AdGem',	'Chicago, IL 60607',	'Front End Developer',	NULL,	NULL,	'Unsuccessful',	'2021-02-19 11:45:48',	'2021-02-28 09:32:23',	1),
(23,	'Lucky Orange',	'Overland Park Kansas',	'Full Stack Javascript Developer',	NULL,	NULL,	'No Feedback',	'2021-01-13 11:07:33',	'2021-01-13 11:07:33',	1),
(24,	'Lifted Logic',	'Overland Park, KS',	'Frontend Web Developer',	'https://liftedlogic.com/',	'Sent over Github links to a couple of projects',	'No Feedback',	'2021-02-16 11:49:10',	'2021-03-17 23:48:35',	1),
(25,	'FountainheadME (Fountainhead Marketing Engineers)',	'Remote',	'Senior Full Stack / Laravel Developer',	NULL,	NULL,	'No Feedback',	'2021-02-16 11:50:37',	'2021-02-16 11:50:37',	1),
(26,	'Affinity, Inc.',	'remote',	'Full Stack Developer',	NULL,	NULL,	'No Feedback',	'2021-01-13 11:54:27',	'2021-01-13 11:54:27',	1),
(27,	'RSNA',	'Oak Brook, IL',	'Software Developer',	NULL,	NULL,	'Unsuccessful',	'2021-02-23 06:03:46',	'2021-03-04 02:32:23',	1),
(28,	'All Information Services, Inc. (AIS)',	'Oakbrook Terrace, IL',	'PHP Developer',	NULL,	NULL,	'No Feedback',	'2021-02-23 23:52:46',	'2021-02-23 23:52:46',	1),
(30,	'PNC Bank (Rathan Kumar, ipivot.io)',	'Pittsburgh, PA',	'UI Developer (Long Term)',	NULL,	NULL,	'No Feedback',	'2021-02-24 06:00:00',	'2021-02-24 06:00:00',	1),
(31,	'Williams-Sonoma (Narendra, Photon Infotech)',	'SFO, CA',	'Sr. VueJS Developer',	NULL,	NULL,	'No Feedback',	'2021-02-26 02:56:36',	'2021-02-26 02:56:36',	1),
(32,	'Punchkick Interactive',	'Chicago, IL',	'Senior Full Stack Web Developer',	'https://www.indeed.com/jobs?q=laravel%20developer&l=Chicago%2C%20IL&ts=1614045657348&rq=1&rsIdx=0&fromage=last&newcount=1&vjk=ce698e38937f969a',	NULL,	'No Feedback',	'2021-02-27 12:09:22',	'2021-02-27 12:09:22',	1),
(33,	'Engtal',	'Chicago, IL',	'Senior PHP Developer',	'https://www.indeed.com/jobs?q=laravel%20developer&l=Chicago%2C%20IL&ts=1614045657348&rq=1&rsIdx=0&fromage=last&newcount=1&vjk=52d2e28264ec49bf&advn=7310571080989518',	'Temporarily remote. Salary $90,000 - $110,000 a year',	'No Feedback',	'2021-02-27 12:29:12',	'2021-02-27 12:29:12',	1),
(38,	'Vault Innovation',	'Chicago, IL',	'Senior Full Stack Developer',	'https://vaultinnovation.com/',	'Received an invitation email via Indeed on Mar 5',	'Unsuccessful',	'2021-03-09 00:11:05',	'2021-03-19 09:01:11',	1),
(39,	'TCS (via Enterprise solution Inc.)',	'Pittsburgh, PA',	'Front End Vue JS developer',	'https://www.tcs.com/',	'Email received from Sagar Kushwah (630-349-0250) on Mar 16. Several exchanges of emails [17th] with a rate confirmation. 12 month contract on W2 with possible relocation.',	'No Feedback',	'2021-03-17 10:30:02',	'2021-03-17 23:18:03',	1),
(43,	'Jobscan',	'Chicago, IL',	'Front-end Software Engineer',	'https://jobs.lever.co/jobscan-2/18c9be83-c9b4-495d-8cc6-6f6624c1b334?ittk=q4exTZOe75W3E6JWZK902zVW7hpL10f-2_O7Bv4Homs',	'Requested salary 110K',	'Unsuccessful',	'2021-03-19 03:34:30',	'2021-03-25 09:08:58',	1),
(44,	'Mecum Auctions',	'Remote',	'Laravel Web Developer',	'https://drive.mecum.com/WebDeveloper',	NULL,	'No Feedback',	'2021-03-19 04:05:24',	'2021-03-19 04:05:24',	1),
(45,	'ShelterLuv',	'Remote, USA only',	'Full Stack Engineer',	'https://www.shelterluv.com/careers/full-stack-laravel-engineer/',	NULL,	'No Feedback',	'2021-03-19 06:24:25',	'2021-03-19 06:24:25',	1),
(46,	'PPC Protect',	'Remote',	'Full Stack Developer (Laravel/ Vue)',	'https://ppcprotect.com/full-stack-web-developer/',	NULL,	'Unsuccessful',	'2021-03-19 08:43:11',	'2021-03-19 20:06:00',	1),
(47,	'Spotawheel',	'Athens, Attica, Greece',	'Mid/Senior PHP Developer',	'https://apply.workable.com/spotawheel/j/57BD6BC7B2/',	NULL,	'No Feedback',	'2021-03-19 09:14:17',	'2021-03-19 09:14:17',	1),
(48,	'Innovation First International, Inc',	'Greenville, Texas (or Remote US)',	'Sr Web Developer (Laravel)',	'https://www.innovationfirst.com/careers/',	NULL,	'No Feedback',	'2021-03-19 09:22:08',	'2021-03-19 09:22:08',	1),
(49,	'Direct client (Tom Martin IDEXCEL Inc.)',	'Chicago, IL (100% remote till Sep 2021)',	'VueJS Developer (Hire 12+ month’s contract or CTH)',	'email to my gmail',	'Expert level VueJs skills is required, Beginner/intermediate level Vuejs exp will not workout.\nNice to have: Node JS, AWS/CICD, Spring boot, Angular.',	'No Feedback',	'2021-03-20 03:26:31',	'2021-03-20 03:26:31',	1),
(50,	'MenuLabs',	'Denver, CO, USA, Remote Allowed',	'Senior Full Stack Developer',	'https://get.menulabs.com/contactless-menus-for-restaurants/',	'Job type: Freelance. Salary: USD 80-160. Posted on VueJobs: Feb 15, 2021',	'No Feedback',	'2021-03-20 04:16:19',	'2021-03-20 04:16:19',	1),
(51,	'Lendflow',	'Remote',	'Senior Frontend Developer (Vue.JS)',	'https://vuejobs.com/jobs/1347-senior-frontend-developer-vue-js',	'Job type: Full-time. Posted: 2 weeks ago. Through VueJobs',	'No Feedback',	'2021-03-22 10:20:16',	'2021-03-22 10:20:16',	1),
(52,	'Nacelle',	'Remote',	'Vue Frontend Developer',	'https://vuejobs.com/jobs/1327-vue-frontend-developer',	'Job type: Full-time. Posted: 3 weeks ago. Found on VueJobs',	'Unsuccessful',	'2021-03-22 10:32:11',	'2021-03-31 06:13:15',	1),
(55,	'sahrann',	'salwann',	'sammann',	NULL,	NULL,	'No Feedback',	'2021-03-23 09:14:08',	'2021-03-23 09:14:48',	17),
(56,	'Honorlock (via TJ Long)',	'remote',	'Senior Fullstack Engineer',	'https://honorlock.com/job/senior-software-engineer/',	NULL,	'No Feedback',	'2021-05-31 01:11:40',	'2021-05-31 01:11:40',	1),
(57,	'CC Marketing Inc.',	'Remote',	'Full-Stack Laravel/Vue Developer(s) (Junior to Senior Level)',	NULL,	NULL,	'No Feedback',	'2021-05-31 01:22:11',	'2021-05-31 01:22:11',	1),
(58,	'Nexient/Levis & Company (Concept, Shradha, Prayag)',	'Remote',	'Sr. Vue JS Developer (Long term Contract)',	NULL,	'This one is a complex project and involves pretty unique things like working with 3D graphics in the app. The person should have a good detailed Vue based experience rather then only embedding some components.\r\nFamiliarity with Vue syntax\r\nAbility to manage different Vue plugins\r\nStrong understanding of mutable and immutable JavaScript objects',	'No Feedback',	'2021-06-04 05:00:00',	'2021-06-04 05:00:00',	1),
(59,	'Ovia Health',	'Boston, Massachusetts (remote)',	'Senior Backend Engineer',	'https://apply.workable.com/oviahealth/j/068CDA5944/',	NULL,	'Unsuccessful',	'2021-06-14 02:13:29',	'2021-06-16 02:01:08',	1),
(60,	'efelle creative',	'Seattle, WA',	'Application Developer',	'https://www.seattlewebdesign.com/about-us/current-job-openings',	NULL,	'No Feedback',	'2021-06-14 02:19:28',	'2021-06-14 02:19:28',	1),
(61,	'Plan A',	'Permanent employee, Full-time · Berlin (Remote)',	'Senior Back End Engineer (PHP)',	'https://plana-earth.jobs.personio.de/job/320337',	NULL,	'Unsuccessful',	'2021-06-14 02:24:59',	'2021-06-16 21:45:48',	1),
(62,	'Cognizant',	'Remote work',	'VueJS Developer',	NULL,	NULL,	'No Feedback',	'2021-07-14 02:04:47',	'2021-07-14 02:04:47',	1),
(63,	'Juvare',	'Remote',	'PHP Web Developer',	NULL,	'10-12 mo contract.  Alyssa Arnson.  Insight Global',	'No Feedback',	'2021-07-09 05:00:00',	'2021-07-09 05:00:00',	1);

-- 2021-07-19 21:15:38
