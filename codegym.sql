-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: codegym
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contest`
--

DROP TABLE IF EXISTS `contest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest` (
  `contest_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  PRIMARY KEY (`contest_id`),
  KEY `username` (`username`),
  CONSTRAINT `contest_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest`
--

LOCK TABLES `contest` WRITE;
/*!40000 ALTER TABLE `contest` DISABLE KEYS */;
INSERT INTO `contest` VALUES (1,'alien_x',180);
/*!40000 ALTER TABLE `contest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contest_problems`
--

DROP TABLE IF EXISTS `contest_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contest_problems` (
  `contest_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `submission` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`contest_id`,`problem_id`),
  KEY `problem_id` (`problem_id`),
  CONSTRAINT `contest_problems_ibfk_1` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE,
  CONSTRAINT `contest_problems_ibfk_2` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contest_problems`
--

LOCK TABLES `contest_problems` WRITE;
/*!40000 ALTER TABLE `contest_problems` DISABLE KEYS */;
/*!40000 ALTER TABLE `contest_problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem`
--

DROP TABLE IF EXISTS `problem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `problem` (
  `problem_id` int(11) NOT NULL AUTO_INCREMENT,
  `problem_statement` text,
  `author` varchar(100) DEFAULT NULL,
  `tester` varchar(100) DEFAULT NULL,
  `difficulty` varchar(100) DEFAULT NULL,
  `sample_input` text,
  `sample_output` text,
  `backend_input` varchar(1024) DEFAULT NULL,
  `backend_output` varchar(1024) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `input_text` text,
  `output_text` text,
  PRIMARY KEY (`problem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem`
--

LOCK TABLES `problem` WRITE;
/*!40000 ALTER TABLE `problem` DISABLE KEYS */;
INSERT INTO `problem` VALUES (1,'During the final part of fashion show all models come to the stage and stay in one row and fashion designer stays to right to model on the right. During the rehearsal, Izabella noticed, that row isn\'t nice, but she can\'t figure out how to fix it.\n\nLike many other creative people, Izabella has a specific sense of beauty. Evaluating beauty of row of models Izabella looks at heights of models. She thinks that row is nice if for each model distance to nearest model with less height (model or fashion designer) to the right of her doesn\'t exceed k (distance between adjacent people equals 1, the distance between people with exactly one man between them equals 2, etc).\n\nShe wants to make row nice, but fashion designer has his own sense of beauty, so she can at most one time select two models from the row and swap their positions if the left model from this pair is higher than the right model from this pair.\n\nFashion designer (man to the right of rightmost model) has less height than all models and can\'t be selected for exchange.\n\nYou should tell if it\'s possible to make at most one exchange in such a way that row becomes nice for Izabella. ',NULL,NULL,NULL,'5 4\n2 3 5 2 5','NO',NULL,NULL,'Row of Models','In first line there are two integers n and k  — number of models and required distance.\n\nSecond line contains n space-separated integers ai  — height of each model. Pay attention that height of fashion designer is not given and can be less than 1.','Print «YES» (without quotes) if it\'s possible to make row nice using at most one exchange, and «NO» (without quotes) otherwise.'),(2,'There are n villages in a line in an area. There are two kinds of tribes A and B that reside there. A village can be either empty or occupied by one of the tribes. An empty village is said to be controlled by a tribe of village A if it is surrounded by villages of tribes A from the left and from the right. Same goes for the tribe B.\n\nFind out the number of villages that are controlled by tribes A and B, respectively.',NULL,NULL,NULL,'4\nA..A..B...B\n..A..\nA....A\n..B..B..B..','4 5\n1 0\n6 0\n0 7',NULL,NULL,'Villages and Tribes','The first line of the input contains an integer T denoting the number of test cases.\n\nThe first line of the input contains a string s denoting the configuration of the villages, each character of which can be \'A\', \'B\' or \'.\'.','For each test case, output two space separated integers denoting the number of tribes controlled by tribe A and B, respectively.'),(3,'Chef is at a Code Expo where many coders are present discussing, solving, sharing, and eavesdropping on solutions :P\n\nHe recently learnt that a former HackerPlant employee, Reziba, who is now working at KodeKarma stole some questions for their KoolKontest. Chef wants to find Reziba, but the only data he has on him, and everyone else present, are their CodeXP ratings, which are distinct.\n\nChef decides to find Reziba through his rating by asking different people present at the expo. Everyone present are arranged in such a way that, assuming a person with rating X, every person with a rating higher than X are on the person\'s right, while every person with a rating lower than X are on the person\'s left.\n\nEveryone present there knows Reziba\'s rating, except Chef, who now asks people where he could find Reziba.\n\nChef initially asks an arbitrary person, who replies by giving information on whether Reziba is to the person\'s left or the person\'s right, depending on whether this person has a higher or lower rating than Reziba.\n\nChef proceeds in that direction for an arbitrary distance and stops and asks the next person encountered, and repeats this procedure.\n\nHowever, Chef will never go beyond a person whose rating Chef has asked before. For example, if Chef was walking to the left and finds a person who already told him to walk to the right then he will not continue going to the person\'s left.\nChef finally finds Reziba when he finally stops in front of Reziba.\n\nDuring Chef\'s search for Reziba, he wrote the sequence of ratings of the people Chef asked in the exact same order, including Reziba\'s rating, which is the last integer in the sequence.\nTowards the end, Chef feels he might\'ve made a mistake while writing this sequence.\n\nGiven the sequence that Chef wrote and Reziba\'s rating, find out whether this sequence is possible or has mistakes.',NULL,NULL,NULL,'2\n5 200\n600 300 100 350 200\n5 890\n5123 3300 783 1111 890','NO\nYES',NULL,NULL,'Chef goes Left Right Left','First line contains number of test cases T.\nThe first line of each test case contains the number of people Chef meets, N and Reziba\'s rating R seperated by a space.\nSecond line of each test case contains N number of space separated ratings from A1 to AN where AN is always equal to R.','For each test case, output a singe line with either YES if the sequence is correct, or print NO if the sequence has mistakes, without quotes.'),(4,'Trans bought a calculator at creatnx\'s store. Unfortunately, it is fake. It has many bugs. One of them is adding two numbers without carrying. Example expression: 12 + 9 will have result 11 in his calculator. Given an expression in the form a + b, please output result from that calculator.',NULL,NULL,NULL,'2\n12 9\n25 25','11\n40',NULL,NULL,'Buggy Calculator','The first line contains an integer T denote the number of test cases. Each test case contains two integers a, b in a single line.','Each test case, print answer in a single line.');
/*!40000 ALTER TABLE `problem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `contest_id` int(11) DEFAULT NULL,
  `problem_id` int(11) DEFAULT NULL,
  `submission_path` varchar(1024) DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `problem_title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`submission_id`),
  KEY `username` (`username`),
  KEY `contest_id` (`contest_id`),
  KEY `problem_id` (`problem_id`),
  CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE,
  CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`contest_id`) REFERENCES `contest` (`contest_id`) ON DELETE CASCADE,
  CONSTRAINT `submissions_ibfk_3` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submissions`
--

LOCK TABLES `submissions` WRITE;
/*!40000 ALTER TABLE `submissions` DISABLE KEYS */;
INSERT INTO `submissions` VALUES (1,'alien_x',1,1,NULL,'2017-11-08','correct_answers','Row of Models'),(2,'alien_x',1,1,NULL,'2017-11-08','wrong_answers','Row of Models'),(3,'alien_x',1,1,NULL,'2017-11-08','time_limit_exceeded','Row of Models');
/*!40000 ALTER TABLE `submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `tag_name` varchar(100) NOT NULL,
  `problem_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_name`,`problem_id`),
  KEY `problem_id` (`problem_id`),
  CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem` (`problem_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image_path` varchar(1024) DEFAULT 'images/batman.jpeg',
  `correct_answers` int(11) DEFAULT '0',
  `wrong_answers` int(11) DEFAULT '0',
  `time_limit_exceeded` int(11) DEFAULT '0',
  `runtime_error` int(11) DEFAULT '0',
  `compilation_error` int(11) DEFAULT '0',
  `problems_solved` int(11) DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('alien_x','$2y$10$KX5vCWCc7/Pjcfs6SXqwsevPZqC4Q6mJ8E.ekKEuQa7fm1ypQUqCO','Akhilesh Devrari','devrari.akhilesh@gmail.com','images/alien_x.jpeg',10,4,6,3,1,7),('vilgax','$2y$10$B35sg1kEQhxk7qn9QaVrCufOJMtMO/JrVmzMb9E3uNECV8Au1L2sC','Vilgax','vilgax@alienforce.com','images/batman.jpeg',0,0,0,0,0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-09 12:34:47
