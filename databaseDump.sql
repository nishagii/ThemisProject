-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2025 at 01:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `themis`
--

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `content`, `image_url`, `author`, `created_at`, `updated_at`) VALUES
(3, 'this is a new blog', 'this blog is about increasing divorce cases in the country', '6804d0d29400c_22000151.png', 13, '2025-04-20 10:47:46', '2025-04-20 10:47:46'),
(4, 'this is another blog post', 'this is about srilankans and their civil rights', '6804d4cb185b7_Screenshot 2024-09-22 103716.png', 13, '2025-04-20 11:04:43', '2025-04-20 11:04:43'),
(6, 'qkwdjb', 'wlpkodjh', '6807cb2ee6f16_3d6525b0-bb64-4972-9026-5da369bd3b4b.jpeg', 13, '2025-04-22 17:00:30', '2025-04-22 17:00:30');

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `client_id`, `client_registered`, `client_name`, `client_number`, `land_number`, `client_email`, `client_address`, `case_number`, `court`, `notes`, `created_at`, `updated_at`, `attorney_id`, `junior_id`, `case_status`, `deleted`) VALUES
(38, 28, 1, 'TmVdIcsvhQOffEm4F2nUGt+BbfAZHzvDzhynjGlYD5s=', 'tKbYHo0ra7Y2A3F8QIL46BQoDbr8NroVceYM98RSVts=', '0', 'Bco5ZbnKautoklSaiCDus22ErflB52NezNqT4nG+KL4=', 'vf7DIREfkE7RWZd6VlrICR0ik5aHSPuKj196RIRumWc=', '0xSnqVTuR12Lc4aTomBL5U2WMAXKYsa8b+FuC03eyJA=', 'supreme court kotte', '23YTdAjk0YFOnD/018OWc8SLsw/RnqP+XU4I1sJuKlooWepPZKg4q2WAlwE3QwnP22WKs7xRz70fZ1scUdOhJmbFFszsLyCbAi1Fw+pAOOU=', '2025-04-24 08:46:49', '2025-04-25 06:28:58', 2, 3, 'closed', 0),
(39, 30, 1, 'xdzoyzzDfOxw4vFi1D5RF7hG9D5kes+rQgpU9RXCpRGBWZwnVa5BuA1ky/9HE7iI', 'kD67M/yz5Pr26K7/XIDH6plDQjB6aBTcIPImiWNksOc=', '0', 'FAIzoKs1Rb/V+TEaNvW6+rkooskLPty5wx2Tfbt3kF/dcFte/it9d3CpJO73Ilfg', 'ipJ/3WQKydIQMYu6btDg4quUg/LJTPqYcMPoyzm3FZY=', 'KGddn0A13+UrlU0w3OyizyC3WJUL8D23dtLCzeGOBVc=', 'supreme court kotte', 'DRkLT69HPJFHU0fuyVsg0AuJWGB2fzGtZxca8xpeZycMoPQCX+Myk7EDynb53cI5', '2025-04-25 03:49:28', '2025-04-25 07:29:42', 2, 3, 'closed', 0),
(40, 29, 1, 'mpmtkw/nl6YvW/+R6CmpMMf9GiXBk0+Dv7SAmFS7tHk=', 'ZwnK1aQjKU142sxZYTg/zaFWms3VLmSlCN44v8waULs=', '0', 'MzVsfYR7bMvWbtJssM4MHUsORCgzRUgaRAHwswzrxjFjdEviJTjeDhlaPKG5yl0A', 'DVGfQ0ZLABIbBh/WujIqi2HIn7pGdRXj3WUNL4gHnFc=', 'Ewb98SR6yl/NP5S1Fe/KJ/p8E5fCuqJAkZ6ezfkusic=', 'panadura', 'Z5aoXawtSLhGhP/6zwVcAsCizDLmFjWMVzlkepQrFkw=', '2025-04-25 04:06:27', '2025-04-25 04:10:18', 2, 3, 'closed', 0),
(43, 26, 1, 'gabJt+bOtp99sffVHg4xfJxyb0eQRq1Ds3SkZ/N8LSM=', 'fpcFxKv9yCmTz9rhFFP6yOPY0TEC3/UawWdfeauQvnY=', '0', 'Y1+lGyfoTm3f0DOEAXVwEptfWWUnmsD3WokY2wIK1/7P2ODHlccUmCIUrmGhfUWV', 'Gd2tbibkpwqSX6WCLpmlZlhUTGCa740gkkAY0+Xp4Bk=', '400-h-34', 'badulla', 'V0ovCxtUvofdEZWNTc/b1AY1ruhI5i9TwxR4UyWYAGw=', '2025-04-26 06:36:01', '2025-04-26 06:36:01', 2, 14, 'ongoing', 0),
(44, 28, 1, '5xAEvOTcLICrMi3PQjlCLbKWXiIqotJHm5RrSfs/BfY=', '3fQJYexPWyoGR+glC8XIfB1GK/N/7VEc7ezM6R1Ou00=', '0', 'HfMZEypCN9CvCxKe/8746bt4xoFKyDbtFWe4wiOynLo=', 'uUdpFN7dViH693r+dDhLlwXedLlgaJneqHH1c7soDjs=', 'SE/3453', 'Badulla', '6JDYLEbuXpdJrbAeDVsWbvYf/5YpvlVwsdDKOOFz9v0=', '2025-04-26 09:21:41', '2025-04-26 09:21:41', 2, 3, 'ongoing', 0),
(45, 30, 1, '+TZeElg2getVL8HcvLxU+16ue7KaZ/ZmPqYqAwAbpjluM0ci9TDvp+BHuo+WN2d6', 'ZnNgg51dMbK+b+wrbUqL/T3NaHzKZr9XrJ4Vv4P94g0=', '0', 'mnQqnAZrdQcDAwrTTHOH0bv9QbbUnktSrT89/JKmg4ozjUav8jhEL8hYC2bPiegP', 'ZUxcLSDqjd5o/0PH7JEy8/5OKy1VYoE6Spsu7nhMg6o=', 'PE/3233', 'Galle', 'hdhXpbVAG7AzWAk9wtbttCV8VtLLbRqj9TfM5JUeZ+w=', '2025-04-26 09:22:45', '2025-04-26 09:33:43', 16, 21, 'closed', 0),
(46, 9, 1, '9ftwzkHSVKKjGNR7ac/dvJ7g/wOk09q7iqxJws2eZY0=', 'g6WyutH9Wqx0CazgGGvjLS9qVyFRL2+PGUPXaETXezE=', '0', 'elvFhqgQA8HSCvms9vtpH4RoA11IX8BngAOdvTWlMdw=', 'yob5SFex1fKhhtjEJtLIIVfxxLFhWfSaCMECFvXPKGY=', '400CS', 'dabulla', 'LzwAHDfksfbgNX1v7ojYjUlJBg5maN0EdO+QCYqkA1rtvFryNqlpdUU0e5ROCcWTjdgVbfyZkbg9LugGrOuL1lnbzkps8HWjM8IN4303e26MnDXAWcAARSGe9tsAeKik', '2025-04-27 21:07:04', '2025-04-27 21:07:04', 2, 14, 'ongoing', 0),
(47, 1, 1, 'FlhCubp/LOwI/soSZPEzecC4rJ85vDiCVNQ9UrNzSAGrW9N7tRE3lsPEecEbMs7J', '9duD+0hT3OpdfUm318sKvkRgYKL78NUKeygG//UKLFA=', '0', 'ml7n2OZyT5TiV1vdsYbH/5Kas+XvouBRt6ZDawbxRsP7tKxfsLZZIomO9zD6MNdt', 'UObW3hx0Z2+f+Hl8IEQXclnhvtNSM6jBHgKY+wgxW5U=', '300CS', 'hanwella', 'mUQ2UVPeAMS/EXe3sLcdB+apkCtoi/+2S0yAkOKm4GbgwMN8P4+/FkRuprvwRJ3ubSdKt5iIyxNLf9o7pjvdzojhO2X5kl3RdJFdAJgwfQMAxAM1RnX4zQ5NBZVoGhEVXD8TgWr7ZFcTjWU6L2JaLQ==', '2025-04-27 21:08:57', '2025-04-27 21:08:57', 2, 21, 'ongoing', 0),
(48, 19, 1, 'uhe03gtdHZlzN86cSo03zslSBp9uMkoFMHmTvGfFG7g=', 'WI19da7lHOtTmsEd32svmMUnUwoDA+jNAbqSMavniwk=', '0', 'M6X76JDjVEeMtEzXgRFp4oEtJyxzhSnBfFw4/IBwocE/ecypg4VYoC5TpJACARur', 'CB4wOPjCo+DnDOcj3xtc296onqxRYFS0aKnaUBRImEE=', '100sa', 'badulla', 'PPr1JwcXU6Up9cT+k5/vRsWohuKdR/6triV1C2HAZjE=', '2025-04-29 06:57:37', '2025-04-29 06:57:47', 2, 3, 'closed', 0),
(49, 1, 1, '6GuqOvXx2oiYGq2TgWEGmUZ1nZR1ncY+D823zYDfAIjASaDmawf6oNFavJktwY4t', 'JShjq85+//XFSznQKlTyGHUxIUhx43gNTO/D0KnZCFs=', '/xlsVMmu22z3jOTCVlrZIx8HA8i+s1TF2fenAeUyLMc=', 'XbouvkO+ecAy61pFbED+wdVTrSj9vNP+za8xwQKWbfnhiYupFNa2Oxyj/fVCon6M', 'E+788ZmGPGnvdGfJEDPW1sfS2Hbfx//LmBxElXX1iZw=', '300ss', 'badulla', 'xl1uSEkp9qxzfXS8G7alrqlcSPTlnpaU+Co5aJcrrwQ=', '2025-04-29 07:17:08', '2025-04-29 07:17:08', 2, 14, 'ongoing', 0),
(50, 11, 1, 'EcLvh7ifbWE7wQPp5LbyeckLW61gtdEuAMEmgzWHJq8=', 'vm/QsqKnuR72ww39pJQMc0MP7n4CbOpuhLs2gC6gfTc=', 'Hqmr6pP2ZN+lpzgGXwZWKhGW+hCcjqeml8Ai/ztGlG8=', 'vw6hs9iItHgDEWiJcLrOSSt2mYBw+hStBKPiGcnz5Nw=', 'L5KLPPBz0mK7PBippz9zhGlnALJaJJgrp8s0ce2ibus=', '100100', 'badulla', 'PFyQy41c+cKH0bz0DqxtIEAouytR/Hbq11LFLxWZGuA=', '2025-04-29 07:59:03', '2025-04-29 07:59:03', 2, 14, 'ongoing', 0);

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `case_id`, `doc_name`, `doc_description`, `file_path`, `uploaded_by`, `uploaded_at`, `updated_at`) VALUES
(5, 38, 'more than 10mb', 'test', '680a77c4357d7_group3_CS_interim.pdf', 4, '2025-04-24 17:41:24', '2025-04-24 17:41:24'),
(6, 40, 'Marriage agreement doc', 'divorce', '680b0b037866a_680a63ef9a6d0_group3_CS_interim.pdf', 13, '2025-04-25 04:09:39', '2025-04-25 04:23:36'),
(8, 39, 'land deeds', 'land', '680b10cd228d0_680a63ef9a6d0_group3_CS_interim.pdf', 13, '2025-04-25 04:34:21', '2025-04-25 04:35:30');

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`name`, `email`, `message`) VALUES
('nadhiya', 'Nashathnadhiya@gmail.com', 'hijfbggbighurihguhguhguhgu'),
('nadhiya', 'Nashathnadhiya@gmail.com', 'hijfbggbighurihguhguhguhgu');

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `clientID`, `caseID`, `comments`, `paymentDesc`, `amount`, `dueDate`, `sent`, `invoiceID`) VALUES
(1, 28, 0, 'We appreciate your prompt payment', 'Client consultation fees', 25000, '2025-05-02', 1, 'INV3537'),
(2, 28, 38, 'your prompt payment is appreciated', 'consultation fees', 10000, '2025-05-02', 1, 'INV6324'),
(3, 29, 40, '', 'jcs', 10000, '2025-04-30', 1, 'INV5493'),
(4, 28, 38, '', 'oijch', 97246, '2025-05-01', 1, 'INV3270'),
(5, 28, 38, '', 'p;ld', 987654, '2025-04-26', 1, 'INV2871');

--
-- Dumping data for table `judgmentsyearwise`
--

INSERT INTO `judgmentsyearwise` (`id`, `judgment_date`, `case_number`, `description`, `judgment_by`, `document_link`) VALUES
(1, '2024-07-26', 'S.C. (Misc.) No. 02/2016', 'K.G. Keerthi Karangoda Amuthagoda, Panukerapeliyta, Hidelana, Ratnapura Vs. Attorney General', 'Hon. K. Priyantha Fernando, J.', 'doc'),
(2, '2024-07-26', 'SC Appeal No: 48/2013', 'Triad Advertising (Pvt) Ltd Vs. Plaintiff Vs. Attorney General, Attorney General’s Department', 'Hon. Mahinda Samayawardhena, J.', 'doc'),
(15, '2024-11-10', 'SC/HC CALA/351/2022', 'sdcjbhvfejnckw webhcjecnjcnejcker', 'HON. P. PADMAN SURASENA, J', 'dfgrtbb'),
(21, '2024-03-01', 'SC/APPEAL/172/2017', 'Madara Mahaliyanage Bandusena, C/O Mr. M.K. Swarnapala Yakdehiwatte, Nivitigala. Petitioner-Petitioner-Appellant Vs. 1. Don Alfred Weerasekera (Deceased) 1A. Don Dharmadasa Weerasekera, Yakdehiwatte, Labungederawatte, Nivitigala. Plaintiff-Respondent-Respondent-Respondent AND 1. Gonakoladeniya Gamage Pantis Appuhamy (Deceased) 1A. Gonakoladeniya Gamage Gamini Premadasa (Deceased) 1B. Gonakoladeniya Gamage, Udayajeewa Premadasa, Kala Bhumi, Pathakada Road, Yakdehiwatte', 'Hon. K. Priyantha Fernando, J', 'qswsdefrgh'),
(24, '2024-03-01', 'SC/APPEAL/225/2014', 'Mohamadu Abu Sali Son of Adapelegedara Mohamed Hasim Lebbe, 25/2, Medillethanna, Ankumbura Medillethanna, Ankumbura SC/APPEAL/225/2014 Vs. 1. Ummu Kaldun daughter of Mohomed Illas, 139, Kurunagala Road, Galewala 2. M.I.M. Falulla 13, Kalawewa Road, Galewela Defendants AND BETWEEN M.I.M. Falulla 13, Kalawewa Road, Galewela 2nd Defendant-Appellant Vs. Mohamadu Abu Sali Son of Adapelegedara Mohamed Hasim Lebbe 25/2, Medillethanna, Ankumbura Plaintiff-Respondent Ummu Kaldun Daughter of Mohomed Illas, 139, Kurunagala Road, Galewala 1st Defendant-Respondent AND NOW BETWEEN Mohamadu Abu Sali Son of Adapelegedara Mohamed Hasim Lebbe, 25/2, Medillethanna, Ankumbura Plaintiff-Respondent-Appellant Vs. 1. Ummu Kaldun Daughter of Mohomed Illas, 139, Kurunagala Road, Galewala And now M.F.M. Younis Stores, 64/A, 6/2, Waththagama Road, Madawala 1st Defendant-Respondent-Respondent M.I.M. Falulla 13, Kalawewa Road, Galewala 2nd Defendant-Appellant-Respondent', 'HON. P. PADMAN SURASENA, J	', 'qswsdefrgh');

--
-- Dumping data for table `knowledge`
--

INSERT INTO `knowledge` (`id`, `topic`, `note`) VALUES
(6, 'year 1962 murder case', 'It involves parties such as plaintiffs, defendants, or petitioners who seek a legal remedy or defense. Legal cases can range from civil disputes, like contract disagreements, to criminal prosecutions for offenses against the law. Each case follows a struc'),
(7, 'land', 'Legal cases can address a wide range of matters, including criminal offenses, civil disputes, or constitutional questions, and follow established procedures to ensure fairness and adherence to legal principles.');

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `attempted_username`, `login_time`, `ip_address`, `status`) VALUES
(1, 13, NULL, '2025-04-27 09:04:07', '::1', 'Success'),
(3, 13, NULL, '2025-04-27 09:05:35', '::1', 'Failure'),
(4, NULL, NULL, '2025-04-27 09:05:52', '::1', 'Failure'),
(5, NULL, '[qwpoid', '2025-04-27 09:08:23', '::1', 'Failure'),
(6, 13, 'lawyer', '2025-04-27 09:10:01', '::1', 'Success'),
(7, 13, 'lawyer', '2025-04-27 09:22:45', '::1', 'Success'),
(8, 4, 'admin', '2025-04-27 09:31:25', '::1', 'Success'),
(9, 4, 'admin', '2025-04-27 09:58:40', '::1', 'Success'),
(10, 13, 'lawyer', '2025-04-27 12:43:19', '::1', 'Success'),
(11, 13, NULL, '2025-04-27 23:57:07', '::1', 'Success'),
(12, 13, NULL, '2025-04-28 08:10:48', '::1', 'Success'),
(13, 13, 'lawyer', '2025-04-28 15:15:15', '::1', 'Success'),
(14, 26, 'client', '2025-04-28 15:15:47', '::1', 'Success'),
(15, 13, 'lawyer', '2025-04-28 17:59:50', '::1', 'Success'),
(16, 13, 'lawyer', '2025-04-28 18:09:59', '::1', 'Success'),
(17, 13, 'lawyer', '2025-04-28 18:11:40', '::1', 'Success'),
(18, 13, 'lawyer', '2025-04-29 12:25:20', '::1', 'Success'),
(19, 26, 'client', '2025-04-29 12:26:03', '::1', 'Success'),
(20, 13, 'lawyer', '2025-04-29 12:27:01', '::1', 'Success');

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `client_id`, `meeting_date`, `meeting_time`, `meeting_purpose`, `meeting_comments`, `meeting_status`, `created_at`) VALUES
(1, 23, '2025-01-23', '08:59:00', 'hvjvjjk', 'b m m bj', 'Pending', '2025-01-03 11:00:20'),
(2, 23, '2025-01-16', '08:07:00', 'joi', 'ijjj', 'Rejected', '2025-01-03 11:02:22'),
(3, 23, '2025-01-16', '08:07:00', 'joi', 'ijjj', 'Accepted', '2025-01-03 11:03:26'),
(4, 23, '2025-01-23', '21:53:00', 'cdsfsgvsvs', 'gvsdgvesgegew', 'Pending', '2025-01-03 11:18:41'),
(5, 23, '2025-01-16', '04:23:00', 'hi', 'hiiiii', 'Rejected', '2025-01-03 11:20:24'),
(6, 23, '2025-01-21', '19:00:00', 'grfgerhrrth', 'rththrethrt', 'Pending', '2025-01-03 11:22:00'),
(7, 23, '2025-01-22', '23:24:00', 'fthfjft', 'gfhfth', 'Pending', '2025-01-03 13:39:13'),
(8, 23, '2025-01-28', '03:21:00', 'fdsvdvdvs', 'fsedvewfew', 'Pending', '2025-01-03 13:45:49'),
(9, 23, '2025-01-30', '23:21:00', '', '', 'Pending', '2025-01-03 13:47:55'),
(10, 23, '2025-01-24', '04:24:00', '8uiekfheifg', 'fuewgrflei', 'Pending', '2025-01-03 13:54:11'),
(11, 23, '2025-01-24', '04:25:00', 'egrewgerg', 'gergwerger', 'Pending', '2025-01-03 13:56:25'),
(12, 23, '2025-01-19', '06:34:00', 'kjghwdiwghflw', 'feghwifewfge', 'Accepted', '2025-01-03 14:24:09'),
(13, 23, '2025-01-24', '06:47:00', 'ytuyfiyygugg', 'gjvkcutl', 'Pending', '2025-01-03 14:28:05'),
(14, 23, '2025-01-25', '04:42:00', 'efgrg', 'gdsf', 'Accepted', '2025-01-03 14:57:28'),
(15, 24, '2022-02-03', '03:32:00', 'testing ban', 'test test', 'Rejected', '2025-02-13 08:31:32'),
(16, 26, '2025-02-22', '02:09:00', 'meeting', 'meeting', 'Pending', '2025-02-20 08:41:00'),
(17, 26, '2025-04-23', '22:30:00', 'ekjgr', 'wlekjg', 'Accepted', '2025-04-22 16:58:14'),
(18, 28, '2025-04-30', '18:25:00', 'jgcjfy', 'tfi', 'Accepted', '2025-04-25 07:50:29'),
(20, 26, '2025-04-27', '17:59:00', 'fwf', 'fwefewf', 'Pending', '2025-04-26 11:28:19');

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `msgid`, `sender`, `receiver`, `message`, `files`, `seen`, `received`, `deleted_sender`, `deleted_receiver`, `date`) VALUES
(1, '13and1', 13, 1, 'hi', NULL, 0, 0, 0, 0, '2025-02-20 12:03:10'),
(2, '25and13', 25, 13, 'hello lawyer', NULL, 0, 0, 0, 0, '2025-02-20 12:05:32'),
(3, '13and25', 13, 25, 'hi', NULL, 0, 0, 0, 0, '2025-02-20 12:06:21'),
(4, '13and25', 13, 25, 'how are you', NULL, 0, 0, 0, 0, '2025-02-20 12:06:30'),
(5, '25and13', 25, 13, 'im fine', NULL, 0, 0, 0, 0, '2025-02-20 12:09:58'),
(6, '25and13', 25, 13, 'how ae you', NULL, 0, 0, 0, 0, '2025-02-20 12:10:04'),
(7, '25and13', 25, 13, 'not loading properly', NULL, 0, 0, 0, 0, '2025-02-20 12:11:35'),
(8, '25and13', 25, 13, 'ayyyoooo', NULL, 0, 0, 0, 0, '2025-02-20 12:11:43'),
(9, '13and25', 13, 25, 'be patient wilu', NULL, 0, 0, 0, 0, '2025-02-20 12:11:55'),
(10, '13and25', 13, 25, 'so annoyinh', NULL, 0, 0, 0, 0, '2025-02-20 12:12:03'),
(11, '25and13', 25, 13, 'stop refresinggg', NULL, 0, 0, 0, 0, '2025-02-20 12:12:37'),
(12, '25and13', 25, 13, 'dahf', NULL, 0, 0, 0, 0, '2025-02-20 12:16:48'),
(13, '25and13', 25, 13, 'hfbdwhufgwug', NULL, 0, 0, 0, 0, '2025-02-20 12:20:49'),
(14, '13and25', 13, 25, 'hello', NULL, 0, 0, 0, 0, '2025-02-20 13:44:47'),
(15, '13and25', 13, 25, 'Hwihlwe', NULL, 0, 0, 0, 0, '2025-02-20 13:55:56'),
(16, '13and25', 13, 25, 'bfhudbf', NULL, 0, 0, 0, 0, '2025-02-20 13:56:35'),
(17, '25and13', 25, 13, 'jhdgfd', NULL, 0, 0, 0, 0, '2025-02-20 13:57:24'),
(18, '13and25', 13, 25, 'hi', NULL, 0, 0, 0, 0, '2025-02-20 13:57:34'),
(19, '25and13', 25, 13, 'how are u', NULL, 0, 0, 0, 0, '2025-02-20 13:57:43'),
(20, '25and13', 25, 13, 'kovdo', NULL, 0, 0, 0, 0, '2025-02-20 13:59:16'),
(21, '25and13', 25, 13, 'cgxjcgugv', NULL, 0, 0, 0, 0, '2025-02-20 14:45:26'),
(22, '25and13', 25, 13, 'hellooo', NULL, 0, 0, 0, 0, '2025-02-20 15:05:08'),
(23, '13and25', 13, 25, 'hiii', NULL, 0, 0, 0, 0, '2025-02-20 15:05:33'),
(24, '25and13', 25, 13, 'dfhfihfuhfuhuh', NULL, 0, 0, 0, 0, '2025-02-20 15:07:29'),
(25, '13and25', 13, 25, 'kjghfeg', NULL, 0, 0, 0, 0, '2025-02-20 15:11:33'),
(26, '13and25', 13, 25, 'hello', NULL, 0, 0, 0, 0, '2025-02-20 19:55:46'),
(27, '13and25', 13, 25, 'hi', NULL, 0, 0, 0, 0, '2025-02-20 20:11:26'),
(28, '13and25', 13, 25, 'h', NULL, 0, 0, 0, 0, '2025-02-20 21:00:29'),
(29, '13and25', 13, 25, 'h', NULL, 0, 0, 0, 0, '2025-02-20 21:00:32'),
(30, '13and25', 13, 25, 'dugfyuguyg', NULL, 0, 0, 0, 0, '2025-02-20 21:00:38'),
(31, '13and25', 13, 25, 'now', NULL, 0, 0, 0, 0, '2025-02-20 21:01:00'),
(32, '13and25', 13, 25, 'jgv', NULL, 0, 0, 0, 0, '2025-02-20 21:01:40'),
(33, '13and25', 13, 25, 'kihhubh', NULL, 0, 0, 0, 0, '2025-02-20 21:01:44'),
(34, '13and25', 13, 25, 'gvyctctyfvyt', NULL, 0, 0, 0, 0, '2025-02-20 21:01:48'),
(35, '13and25', 13, 25, 'ygtftfr', NULL, 0, 0, 0, 0, '2025-02-24 18:08:26'),
(36, '25and13', 25, 13, 'dhgdhug', NULL, 0, 0, 0, 0, '2025-02-24 18:10:09'),
(37, '13and25', 13, 25, 'hdbfydf', NULL, 0, 0, 0, 0, '2025-02-24 18:10:29'),
(38, '13and25', 13, 25, 'lfkjdhgfdj', NULL, 0, 0, 0, 0, '2025-04-20 19:11:21'),
(39, '13and25', 13, 25, 'ekfjeukfgdyf', NULL, 0, 0, 0, 0, '2025-04-22 22:26:12');

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `timestamp`, `status`) VALUES
(1, 2, 'Task \'Print this document\' has been assigned to you. Check your task board', '2025-04-25 05:57:12', 'unread'),
(2, 29, 'You have been added to a new case. View the case page for more details.', '2025-04-25 06:06:27', 'read'),
(3, 16, 'Task \'nma\' has been assigned to you. Check your task board', '2025-04-25 07:31:52', 'unread'),
(4, 14, 'Task \'eff\' has been assigned to you. Check your task board', '2025-04-25 07:32:45', 'unread'),
(5, 13, 'Task \'eff\' has been marked as completed. Check out the task board for review', '2025-04-25 07:33:13', 'read'),
(6, 25, 'Task \'eff\' has been marked as completed. Check out the task board for review', '2025-04-25 07:33:13', 'unread'),
(7, 27, 'Task \'eff\' has been marked as completed. Check out the task board for review', '2025-04-25 07:33:13', 'unread'),
(8, 29, 'Invoice #INV5493 has been sent to you. Please check your email.', '2025-04-25 07:35:39', 'read'),
(9, 28, 'Invoice #INV3537 has been sent to you. Please check your email.', '2025-04-25 09:39:42', 'unread'),
(10, 28, 'Invoice #INV3270 has been sent to you. Please check your email.', '2025-04-25 09:40:14', 'unread'),
(11, 28, 'Invoice #INV2871 has been sent to you. Please check your email.', '2025-04-25 10:04:56', 'unread'),
(12, 26, 'You have been added to a new case. View the case page for more details.', '2025-04-26 08:36:01', 'read'),
(13, 28, 'You have been added to a new case. View the case page for more details.', '2025-04-26 11:21:41', 'unread'),
(14, 5, 'You have been added to a new case. View the case page for more details.', '2025-04-26 11:22:45', 'unread');

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`transaction_id`, `case_number`, `remarks`, `amount`, `payment_status`, `created_at`) VALUES
('cs_test_a1ur9fK8pFMdHDfuxVDCdl0INGktepWKLeoa7d2OmiQhKHsSWoiPlrT1v4', '400-h-34', 'payings for case', 3000.00, 'paid', '2025-04-26 09:51:16'),
('cs_test_a1xtWaMJUiLfXxNluSv3AkzWuouH4XFu2BtD8sBcAmzjqTtN3ub9dnI7Xh', '400-h-34', 'bording fees', 4500.00, 'paid', '2025-04-26 10:15:19');

--
-- Dumping data for table `reset_tokens`
--

INSERT INTO `reset_tokens` (`id`, `email`, `token`, `expires_at`, `created_at`) VALUES
(1, 'Nashathnadhiya@gmail.com', '181982', '2025-04-25 10:13:46', '2025-04-25 07:58:46');

--
-- Dumping data for table `sc_rules`
--

INSERT INTO `sc_rules` (`id`, `rule_number`, `published_date`, `sinhala_link`, `tamil_link`, `english_link`) VALUES
(14, 'No.2195/28', '2020-09-30', '/themisrepo/public/assets/scrulesUploads/sinhala_link_6808d4d82097c5.79218930.pdf', '/themisrepo/public/assets/scrulesUploads/tamil_link_6808d4d820ba07.24229576.pdf', '/themisrepo/public/assets/scrulesUploads/english_link_6808d4d820d9d2.00010090.pdf'),
(15, 'No.2212/54', '2021-01-29', '/themisrepo/public/assets/scrulesUploads/sinhala_link_680b1889e0ccf0.80405674.pdf', '/themisrepo/public/assets/scrulesUploads/tamil_link_680b1889e10791.58309986.pdf', '/themisrepo/public/assets/scrulesUploads/english_link_680b1889e136e5.79305281.pdf');

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskID`, `name`, `description`, `task_doc`, `assigneeID`, `assignedDate`, `deadlineDate`, `deadlineTime`, `status`, `comment`, `completionDate`, `priority`) VALUES
(18, 'fill forms', 'form', NULL, 2, '2024-11-26', '2024-11-28', '20:36:00', 'overdue', NULL, NULL, 'low'),
(21, 'nadhiya', 'fill form', NULL, 2, '2024-11-26', '2024-11-28', '14:48:00', 'overdue', NULL, NULL, 'high'),
(22, 'task 1', 'fill form', NULL, 3, '2024-11-26', '2024-11-29', '23:00:00', 'overdue', NULL, NULL, 'high'),
(23, 'task 2', 'description', NULL, 2, '2024-11-27', '2024-11-27', '19:06:00', 'overdue', NULL, NULL, 'medium'),
(25, 'Nadhiya', 't', NULL, 3, '2024-11-28', '2024-11-28', '23:31:00', 'overdue', NULL, NULL, 'high'),
(27, 'research task', 'legal citations', NULL, 3, '2024-11-28', '2024-11-30', '11:33:00', 'overdue', NULL, NULL, 'high'),
(42, 'prepare the divorce agreement', 'case number 56', NULL, 14, '2025-04-06', '2025-04-08', '04:35:00', 'completed', NULL, NULL, 'high'),
(48, 'fill that form', 'today', NULL, 14, '2025-04-07', '2025-04-25', '09:40:00', 'completed', NULL, NULL, 'high'),
(49, 'nadhiya', 'task ', NULL, 14, '2025-04-07', '2025-04-24', '09:57:00', 'completed', NULL, NULL, 'high'),
(50, 'fill forms', 'divorce form', NULL, 2, '2025-04-20', '2025-05-01', '10:40:00', 'pending', NULL, NULL, 'high'),
(51, 'checking the flow', 'mark as completed so that i can review', NULL, 14, '2025-04-20', '2025-04-24', '11:19:00', 'completed', NULL, NULL, 'high'),
(52, 'checking notifications', 'after getting notifications go to task board', NULL, 14, '2025-04-20', '2025-04-25', '11:25:00', 'completed', NULL, NULL, 'high'),
(53, 'cruiseer', 'car', NULL, 14, '2025-04-22', '2025-04-24', '09:27:00', 'overdue', NULL, NULL, 'medium'),
(54, 'flow check', 'flow check', NULL, 14, '2025-04-22', '2025-04-24', '09:54:00', 'completed', NULL, NULL, 'high'),
(55, 'nadhiya', 'ddmndkjv', NULL, 14, '2025-04-22', '2025-04-25', '22:24:00', 'completed', NULL, NULL, 'high'),
(56, 'Case file review and summary preparation', 'review the assigned case file thoroughly and prepare a concise summary', NULL, 14, '2025-04-22', '2025-04-24', '11:11:00', 'completed', NULL, NULL, 'high'),
(57, 'Case law compilation', 'Research and compile case laws to support our position', NULL, 14, '2025-04-24', '2025-04-24', '09:52:00', 'overdue', NULL, NULL, 'high'),
(58, 'Precedent research and summary', 'identify precedents applicable to our current motive ', NULL, 14, '2025-04-24', '2025-04-25', '09:56:00', 'completed', NULL, NULL, 'high'),
(59, 'Client meeting summary draft', 'create a summary of today\'s meeting and follow up any actions', '6809c071c6952_group3_CS_interim.pdf', 14, '2025-04-24', '2025-04-25', '10:11:00', 'completed', NULL, NULL, 'high'),
(60, 'court document review', 'review the affidavit attached to this task', NULL, 14, '2025-04-24', '2025-05-02', '22:11:00', 'completed', 'references should be added', '2025-04-24 07:24:05', 'high'),
(61, 'Legal argument outline', 'address the specific issues attached in the pdf', '6809e81227f21_22000151.pdf', 14, '2025-04-24', '2025-04-25', '12:59:00', 'overdue', NULL, NULL, 'high'),
(62, 'Prepare a brief summary', 'the pdf is attached', '680b07b63e45d_680a63ef9a6d0_group3_CS_interim.pdf', 14, '2025-04-25', '2025-04-26', '09:26:00', 'overdue', NULL, NULL, 'high'),
(63, 'Print this document', 'attached below', '680b08189620e_680a63ef9a6d0_group3_CS_interim.pdf', 2, '2025-04-25', '2025-04-26', '09:28:00', 'overdue', NULL, NULL, 'high'),
(64, 'nma', 'jshgs', '680b1e482eed6_680a63ef9a6d0_group3_CS_interim.pdf', 16, '2025-04-25', '2025-04-26', '11:03:00', 'overdue', NULL, NULL, 'high'),
(65, 'eff', 'f', NULL, 14, '2025-04-25', '2025-05-03', '11:03:00', 'completed', 'hshd', '2025-04-25 05:33:13', 'high');

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `name`, `description`, `uploaded_by`, `uploaded_date`, `document_link`) VALUES
(2, 'Client Agreement Template', 'Template for client agreements', 'Jane (Admin)', '2024-09-14 18:30:00', ''),
(8, 'test doc 1', 'this is a test template', '', '2024-12-11 07:47:56', '/themisrepo/public/assets/templateUploads/template_675943ac8e7439.94031445.pdf'),
(11, 'test doc', 'testing one', '', '2024-12-17 07:41:10', '/themisrepo/public/assets/templateUploads/template_67612b16218a64.69732484.pdf'),
(12, 'kfjgbkjfdbgkf', 'kjbjkbk', '', '2025-02-20 09:08:47', '/themisrepo/public/assets/templateUploads/template_67b6f11f7d6cb5.57126298.pdf');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Nishagi', 'Deeranatha', 'nisha', 'jeewanthadeherath04@gmail.com', '0713285117', '$2y$10$7/vYTQM5d5eue2n50Zd2SuvLEpvcVKQjKSzMBhoXPFn3zJtX9HU1y', 'client', '2024-11-24 03:24:32', '2025-04-26 18:51:40'),
(2, 'Nishagi', 'Deeranatha', 'fefwf', 'jeewa@gmail.com', '0713285117', '$2y$10$nIAgeLAtSGkclfOh6pCpiO3/sIxybI7DpAJR7eMrLp8DbC8viqx.a', 'attorney', '2024-11-24 08:45:33', '2024-11-24 17:45:01'),
(3, 'nadhiya', 'nashath', 'nadhiya', 'Nashathnadhiya@gmail.com', '0768811077', '$2y$10$nrXboaYiP95vNaQKrb7biOULoaJFV1sBfLnmQawocOklrSh5/i9Gi', 'junior', '2024-11-24 09:41:56', '2024-11-24 17:44:48'),
(4, 'admin', 'admin', 'admin', 'admin@gmail.com', '0768811077', '$2y$10$4GPmRMS9Wz7FxxCIKohzQOJazLXGGrbaGhb5xHGwfrt4gce.oTvyS', 'admin', '2024-11-24 10:10:33', '2024-11-24 10:11:07'),
(5, 'Nadia', 'Nashath', 'nadia', 'nadianashath@gmail.com', '0768811077', '$2y$10$MyrFYL521OmvlCQ/3NI1g.0Bh2K57q7q710GYXelPtqES0kLYGcRS', 'client', '2024-11-25 12:49:28', '2025-02-25 13:36:32'),
(6, 'client', '1', 'client1', 'realtest@gmail.com', '0768811077', '$2y$10$29lfIqMue7gOVHAwoDRS4eynbnpxRdmNvg7kvWZAmw2vSvxqh/53m', 'client', '2024-11-26 08:55:48', '2024-11-26 08:55:48'),
(7, 'nadii', 'nadii', 'nadii', 'nadi@gmail.com', '0768811077', '$2y$10$cMH9aN.diYnn/cEtw6iK3OZxmrQtPLub8P1u4Oo17YHS6VeiPErQG', 'client', '2024-11-26 09:15:43', '2024-11-26 09:15:43'),
(8, 'nadhiya', 'nashath', 'nad', 'nad@gmail.com', '0768811077', '$2y$10$tQ1/2bssJ/pwP7u2IjqNRuYCsvKzqbhdFZfcg1rWLToLBOf9/nHeK', 'client', '2024-11-26 13:34:20', '2024-11-26 13:34:20'),
(9, 'test', '2', 'test2', 'test2@gmail.com', '0768811077', '$2y$10$iKV5/DBdIA2OPUIceoYQ0uJ2hoq6XWpjQRFbh3t3X6pCCDY8QraSy', 'client', '2024-11-26 14:23:17', '2024-11-26 14:23:17'),
(10, 'test3', 'test3', 'test3', 'test3@gmail.com', '0768811077', '$2y$10$fCrRxvrcOFulH75FYJbbneFuQr3wdAOqoKIj0YDQiRmom0ffFiYAK', 'client', '2024-11-26 15:25:01', '2024-11-26 15:25:01'),
(11, 'test6', 'test6', 'test6', 'test@gmail.com', '0768811077', '$2y$10$4z3gvm.9v2iFLmQWXYuvZ.vC6GPDnjHN5.5fEnkcBQRe2k3FsrVoO', 'client', '2024-11-27 10:57:55', '2024-11-27 10:57:55'),
(12, 'test9', 'test9', 'test9', 'test9@gmail.com', '0768811077', '$2y$10$oYots66bMmqoTvYN4xn/DeWCVxry7jtFWgqQ1Nfa/EOn59XohSRJG', 'client', '2024-11-27 12:29:45', '2024-11-27 12:29:45'),
(13, 'lawyer', 'lawyer', 'lawyer', 'lawyer@gmail.com', '0773467809', '$2y$10$3DwTeJcGbDr64lP3sNShXeqiJY.jbOy.XBtVZ5myHIM.sciDkXELm', 'lawyer', '2024-11-28 14:32:20', '2024-11-28 14:33:18'),
(14, 'junior', 'junior', 'junior', 'junior@gmail.com', '0774578149', '$2y$10$Z6PCYYYGxfrqBzd2j7wWCu7QHrLRLu1EKZCEcyx6.1gQW5FJrrsH2', 'junior', '2024-11-28 14:34:31', '2024-11-28 14:35:35'),
(15, 'test10', 'test10', 'test10', 'test10@gmail.com', '0763456789', '$2y$10$YqEvWYrGySNlHcJDuHGjXeV.1J86JZk./tdb0h4.e2NcqaUWZauUi', 'client', '2024-11-28 15:02:18', '2024-11-28 15:02:18'),
(16, 'attorney', 'attorney', 'attorney', 'attorney@gmail.com', '0752456273', '$2y$10$MoLcVdEi9j/9brTLFotiwuS37kwljth8k2zaVC1jtAksHd05A0idS', 'attorney', '2024-11-28 16:47:19', '2024-11-28 16:47:44'),
(17, 'precedent', 'precedent', 'precedent', 'precedent@gmail.com', '0725637467', '$2y$10$XDtfsCrgp7u5Hj9VobAdzu13fI9wxhBR7CO10Bwtz8xGejRa.D2ci', 'precedent', '2024-11-28 17:50:27', '2024-11-28 17:50:46'),
(18, 'test55', 'test55', 'test55', 'test55@gmail.com', '0742456735', '$2y$10$yNvitsm1fK.TVkJFl5TWROJYAEL7nKhMFN0cKsar2.6f/bKP7cdqi', 'client', '2024-11-28 17:57:56', '2024-11-28 17:57:56'),
(19, 'test99', 'test99', 'test99', 'test99@gmail.com', '0752456378', '$2y$10$FVw3aOuuqHd3yZ/fQfwzTuZNkMk9ACqjkpMAb8/hVjAQQWk5JRVDW', 'client', '2024-11-29 03:42:04', '2024-11-29 03:42:04'),
(21, 'Nishagi', 'Deeranatha', 'ygu', 'vidhu@gmail.com', '0713285117', '$2y$10$9xyMTxwndOfZnf2diYsC6uppA3y2uxwmre/omhuYsSlMXBjWc16hy', 'junior', '2024-12-02 08:44:47', '2024-12-02 08:44:47'),
(22, 'nishsa', 'ghvgjcj', 'ygyfkuyf', 'vihbgggkgd@gmail.com', '0713289117', '$2y$10$MymADBgiKuPX6wMUShaRV.Z6axoiUrZjTPCpHN6WF2YUKeAs.m8Zi', 'precedent', '2024-12-02 08:58:06', '2024-12-02 08:58:06'),
(23, 'nishagi', 'jeewantha', 'testing', 'testing@gmail.com', '0703285117', '$2y$10$plC96NgRcPu7amdv4yAh3Oc3uEfsQaA6/W/sjL1XpzyQYEtN8rUTG', 'client', '2025-01-03 10:14:19', '2025-01-03 10:14:19'),
(24, 'meeting(pw:123)', 'testing', 'meeting', 'tests@gmail.com', '0572222345', '$2y$10$GeCackwVESraT4YbBjkwleDpTY.9fSP3jxYZKrhIJEWTmNZ/Wh95C', 'client', '2025-02-13 08:30:26', '2025-02-13 08:30:26'),
(25, 'lawyer2', 'lawyer2', 'lawyer2', 'lawyer2@gmail.com', '0768811073', '$2y$10$QOBdoMI282QSuSd9.CPuBORZ3Fj10qm.OXQZgNio7lXmv8wGtAG76', 'lawyer', '2025-02-20 06:34:14', '2025-02-20 06:34:55'),
(26, 'client', 'client', 'client', 'client@gmail.com', '0773467805', '$2y$10$wHPdwPRJFwDmR.lKPlCKmuPr/2X6.EFwRoCmSTJUuAA.koKRNTJm2', 'client', '2025-02-20 08:37:01', '2025-02-20 08:37:01'),
(27, 'Nadhiya', 'Arafa', 'Arafa', 'arafa@gmail.com', '0763456785', '$2y$10$Uu43Yl/HQgbw.x3EB59ahOi7VFd6.pj9nv6N7PB1vYuRAa/YN4x2G', 'lawyer', '2025-04-21 04:20:55', '2025-04-21 04:20:55'),
(28, 'Kasun', 'Perera', 'kasun', 'kasun@gmail.com', '0767711077', '$2y$10$qzLp/xPbjnCAPYajVCxdMOGNmkjYFXHhR/OAgsf/mHm.Pe.YboXjK', 'client', '2025-04-23 04:40:17', '2025-04-23 04:40:17'),
(29, 'Harinda', 'Khan', 'Harinda', 'harinda@gmail.com', '0777667809', '$2y$10$ousi4/CaT3hKCO7JlJcoHeyN37KsSy0.S0/zWtsnuExrxZNRzQeQ2', 'client', '2025-04-25 03:45:00', '2025-04-25 03:45:00'),
(30, 'Priyanka ', 'Chopra', 'Priyanka', 'priyanka@gmail.com', '0763456745', '$2y$10$SMKDjJ6uEogsbsLgsxbHn.ScVVtajDkdMYWIunN9oNlbmBUF1xmoG', 'client', '2025-04-25 03:46:46', '2025-04-25 03:46:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
