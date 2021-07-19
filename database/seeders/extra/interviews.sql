-- Adminer 4.8.1 MySQL 8.0.25-0ubuntu0.20.10.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

TRUNCATE `interviews`;
INSERT INTO `interviews` (`id`, `date`, `time`, `interviewer`, `notes`, `status`, `submission_id`, `created_at`, `updated_at`) VALUES
(1,	'2021-03-02',	'14:00:00',	'Tyler Etters - vice president - tetters@highlandsolutions.com',	'A second interview is scheduled for Thursday Mar 4th',	'Completed',	2,	'2021-03-02 00:59:46',	'2021-03-03 09:13:08'),
(2,	'2021-03-04',	'13:00:00',	'Stu Heiss, Brad Zasada, Jordan Welch, Ashish Abraham, Curtis Blackwell',	'1 hour initially planned.\r\nRequested cancellation due to a family emergency where I needed to make an urgent flight booking.',	'Canceled',	2,	'2021-03-03 09:27:52',	'2021-03-09 02:12:34'),
(3,	'2021-03-10',	'14:30:00',	'Terry Harmon - terry@vaultinnovation.com',	'phone call',	'Completed',	38,	'2021-03-09 00:24:04',	'2021-03-11 11:26:19'),
(4,	'2021-03-12',	'11:00:00',	'Tyler Etters, Stu Heiss, Brad Zasada, Curtis Blackwell, Jordan Welch, Ashish Abraham',	'Zoom Meeting\nus02web.zoom.us/j/81680246996 (ID: 81680246996)',	'Completed',	2,	'2021-03-11 01:50:51',	'2021-03-23 07:45:44'),
(5,	'2021-03-26',	'10:00:00',	'Safwan',	'Senan',	'Upcoming',	55,	'2021-03-23 09:15:52',	'2021-03-23 09:17:34'),
(6,	'2021-07-14',	'15:00:00',	'Noor Sulaiman',	'Please Join via WebEx:\nWebex:   https://cognizantcorp.webex.com/meet/Noor.Sulaiman',	'Completed',	62,	'2021-07-14 02:08:19',	'2021-07-16 10:40:28'),
(8,	'2021-07-13',	'11:00:00',	'Chuck',	'via video on Microsoft Teams.  I canceled because I was sick',	'Canceled',	63,	'2021-07-16 11:16:25',	'2021-07-20 01:38:10'),
(9,	'2021-07-19',	'02:00:00',	'Chuck',	'Join with a video conferencing device\neveryonematters@m.webex.com\nVideo Conference ID: 118 552 637 9',	'Completed',	63,	'2021-07-17 08:30:20',	'2021-07-20 01:38:23');

-- 2021-07-19 21:15:19
