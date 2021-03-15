-- Adminer 4.8.0 MySQL 8.0.23-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `interviews` (`id`, `date`, `time`, `interviewer`, `notes`, `status`, `submission_id`, `created_at`, `updated_at`) VALUES
(1,	'2021-03-02',	'14:00:00',	'Tyler Etters - vice president - tetters@highlandsolutions.com',	'A second interview is scheduled for Thursday Mar 4th',	'Completed',	2,	'2021-03-02 00:59:46',	'2021-03-03 09:13:08'),
(2,	'2021-03-04',	'13:00:00',	'Stu Heiss, Brad Zasada, Jordan Welch, Ashish Abraham, Curtis Blackwell',	'1 hour initially planned.\r\nRequested cancellation due to a family emergency where I needed to make an urgent flight booking.',	'Canceled',	2,	'2021-03-03 09:27:52',	'2021-03-09 02:12:34'),
(3,	'2021-03-10',	'14:30:00',	'Terry Harmon - terry@vaultinnovation.com',	'phone call',	'Completed',	38,	'2021-03-09 00:24:04',	'2021-03-11 11:26:19'),
(4,	'2021-03-12',	'11:00:00',	'Tyler Etters, Stu Heiss, Brad Zasada, Curtis Blackwell, Jordan Welch, Ashish Abraham',	'Zoom Meeting\nus02web.zoom.us/j/81680246996 (ID: 81680246996)',	'Upcoming',	2,	'2021-03-11 01:50:51',	'2021-03-11 01:50:51');

INSERT INTO `submissions` (`id`, `company`, `location`, `position`, `url`, `note`, `status`, `created_at`, `updated_at`) VALUES
(2,	'Highland',	'Chicago, IL',	'Full Stack Application Developer',	'https://highland.bamboohr.com/jobs/view.php?id=60&source=other',	NULL,	'No Feedback',	'2021-02-19 11:22:26',	'2021-03-02 01:21:39'),
(3,	'AdGem',	'Chicago, IL 60607',	'Front End Developer',	NULL,	NULL,	'Unsuccessful',	'2021-02-19 11:45:48',	'2021-02-28 09:32:23'),
(23,	'Lucky Orange',	'Overland Park Kansas',	'Full Stack Javascript Developer',	NULL,	NULL,	'No Feedback',	'2021-01-13 11:07:33',	'2021-01-13 11:07:33'),
(24,	'Lifted Logic',	'Overland Park, KS',	'Frontend Web Developer',	NULL,	NULL,	'Unsuccessful',	'2021-02-16 11:49:10',	'2021-03-02 07:20:02'),
(25,	'FountainheadME (Fountainhead Marketing Engineers)',	'Remote',	'Senior Full Stack / Laravel Developer',	NULL,	NULL,	'No Feedback',	'2021-02-16 11:50:37',	'2021-02-16 11:50:37'),
(26,	'Affinity, Inc.',	'remote',	'Full Stack Developer',	NULL,	NULL,	'No Feedback',	'2021-01-13 11:54:27',	'2021-01-13 11:54:27'),
(27,	'RSNA',	'Oak Brook, IL',	'Software Developer',	NULL,	NULL,	'Unsuccessful',	'2021-02-23 06:03:46',	'2021-03-04 02:32:23'),
(28,	'All Information Services, Inc. (AIS)',	'Oakbrook Terrace, IL',	'PHP Developer',	NULL,	NULL,	'No Feedback',	'2021-02-23 23:52:46',	'2021-02-23 23:52:46'),
(30,	'PNC Bank (Rathan Kumar, ipivot.io)',	'Pittsburgh, PA',	'UI Developer (Long Term)',	NULL,	NULL,	'No Feedback',	'2021-02-24 06:00:00',	'2021-02-24 06:00:00'),
(31,	'Williams-Sonoma (Narendra, Photon Infotech)',	'SFO, CA',	'Sr. VueJS Developer',	NULL,	NULL,	'No Feedback',	'2021-02-26 02:56:36',	'2021-02-26 02:56:36'),
(32,	'Punchkick Interactive',	'Chicago, IL',	'Senior Full Stack Web Developer',	'https://www.indeed.com/jobs?q=laravel%20developer&l=Chicago%2C%20IL&ts=1614045657348&rq=1&rsIdx=0&fromage=last&newcount=1&vjk=ce698e38937f969a',	NULL,	'No Feedback',	'2021-02-27 12:09:22',	'2021-02-27 12:09:22'),
(33,	'Engtal',	'Chicago, IL',	'Senior PHP Developer',	'https://www.indeed.com/jobs?q=laravel%20developer&l=Chicago%2C%20IL&ts=1614045657348&rq=1&rsIdx=0&fromage=last&newcount=1&vjk=52d2e28264ec49bf&advn=7310571080989518',	'Temporarily remote. Salary $90,000 - $110,000 a year',	'No Feedback',	'2021-02-27 12:29:12',	'2021-02-27 12:29:12'),
(38,	'Vault Innovation',	'Chicago, IL',	'Senior Full Stack Developer',	'https://vaultinnovation.com/',	'Received an invitation email via Indeed on Mar 5',	'No Feedback',	'2021-03-09 00:11:05',	'2021-03-09 11:16:43');

-- 2021-03-14 04:17:36
