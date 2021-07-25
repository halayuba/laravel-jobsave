-- Adminer 4.8.1 MySQL 8.0.25-0ubuntu0.20.10.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

TRUNCATE `interviews`;
INSERT INTO `interviews` (`id`, `date`, `time`, `interviewer`, `notes`, `status`, `submission_id`, `created_at`, `updated_at`, `url`) VALUES
(1,	'2021-03-02',	'14:00:00',	'Tyler Etters - vice president - tetters@highlandsolutions.com',	'A second interview is scheduled for Thursday Mar 4th',	'Completed',	2,	'2021-03-02 00:59:46',	'2021-03-03 09:13:08',	NULL),
(2,	'2021-03-04',	'13:00:00',	'Stu Heiss, Brad Zasada, Jordan Welch, Ashish Abraham, Curtis Blackwell',	'1 hour initially planned.\r\nRequested cancellation due to a family emergency where I needed to make an urgent flight booking.',	'Canceled',	2,	'2021-03-03 09:27:52',	'2021-03-09 02:12:34',	NULL),
(3,	'2021-03-10',	'14:30:00',	'Terry Harmon - terry@vaultinnovation.com',	'phone call',	'Completed',	38,	'2021-03-09 00:24:04',	'2021-03-11 11:26:19',	NULL),
(4,	'2021-03-12',	'11:00:00',	'Tyler Etters, Stu Heiss, Brad Zasada, Curtis Blackwell, Jordan Welch, Ashish Abraham',	'Zoom Meeting:  (ID: 81680246996)',	'Completed',	2,	'2021-03-11 01:50:51',	'2021-07-26 01:06:32',	'Https://us02web.zoom.us/j/81680246996'),
(5,	'2021-03-26',	'10:00:00',	'Safwan',	'Senan',	'Upcoming',	55,	'2021-03-23 09:15:52',	'2021-03-23 09:17:34',	NULL),
(6,	'2021-07-14',	'03:00:00',	'Noor Sulaiman',	'Technical Panelist:  Noor Sulaiman',	'Completed',	62,	'2021-07-14 02:08:19',	'2021-07-26 01:13:47',	'https://cognizantcorp.webex.com/meet/Noor.Sulaiman'),
(8,	'2021-07-13',	'11:00:00',	'Chuck',	'via video on Microsoft Teams.  I canceled because I was sick',	'Canceled',	63,	'2021-07-16 11:16:25',	'2021-07-20 01:38:10',	NULL),
(9,	'2021-07-19',	'02:00:00',	'Chuck',	'Join with a video conferencing device\neveryonematters@m.webex.com\nVideo Conference ID: 118 552 637 9',	'Completed',	63,	'2021-07-17 08:30:20',	'2021-07-26 01:12:22',	'https://teams.microsoft.com/l/meetup-join/19%3ameeting_NWY1YzU3M2QtYjU1MS00N2Y0LWJiN2YtNWE5NTU1MjE1ZWNi%40thread.v2/0?context=%7b%22Tid%22%3a%2252217199-75dd-4e06-8891-77a8eb5eee12%22%2c%22Oid%22%3a%22a5244949-72f3-4f48-9962-877f034d2a3d%22%7d'),
(10,	'2021-07-23',	'03:00:00',	'Erin Foster',	'30 Minute ZOOM Meeting.  You can also dial in using your phone.\nUS: +1 301 715 8592, +1 312 626 6799, +1 646 876 9923, +1 253 215 8782, +1 346 248 7799, +1 408 638 0968, +1 669 900 6833\nMeeting ID: 999-624-42336',	'Completed',	64,	'2021-07-22 22:53:09',	'2021-07-26 01:10:14',	'https://www.google.com/url?q=https%3A%2F%2Fgrin-co.zoom.us%2Fj%2F99962442336&sa=D&source=calendar&usd=2&usg=AOvVaw3ZeymrTmmpR5vYRwWsAx_v'),
(11,	'2021-07-26',	'11:30:00',	'Sara Flood, Trent Warren',	'Please answer each question in great detail in order to display your previous experience developing with Vue / CSS / TypeScript / HTML. I would be prepared for very technical questions and possible a whiteboard session just in case! I have also listed the JD below for your review prior to your interview. Or call in (audio only)\n+1 720-449-2800,,772793468#   United States, Denver\nPhone Conference ID: 772 793 468#',	'Upcoming',	65,	'2021-07-24 00:50:19',	'2021-07-26 01:08:04',	'https://teams.microsoft.com/l/meetup-join/19%3ameeting_NzBmYTNlYTYtNzhmOC00YzQ5LWJjZTctMDNmYTFhMjViZjc3%40thread.v2/0?context=%7b%22Tid%22%3a%22b9fec68c-c92d-461e-9a97-3d03a0f18b82%22%2c%22Oid%22%3a%22dfecb516-394d-489d-8ffa-3ba275c9317c%22%7d');

-- 2021-07-25 20:16:44
