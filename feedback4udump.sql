USE feedback4u;
GRANT ALL PRIVILEGES ON feedback4u.* TO 'fb4uAdmin'@'%' IDENTIFIED BY 'fb4uAdminfb4uAdminx2';
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idRole` int NOT NULL AUTO_INCREMENT,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRole`)
);
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Student');

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `idSubject` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSubject`)
) ;
INSERT INTO `subjects` VALUES (1,'Front-end Developer'),(2,'Back-end Developer'),(3,'UX Design'),(4,'Cyber Security'),(5,'Python'),(6,'Database');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(245) DEFAULT NULL,
  `idRole` int DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `FK_Users_Roles_idx` (`idRole`),
  CONSTRAINT `FK_Users_Roles` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`)
);
INSERT INTO `users` VALUES (1,'Admin', 'Admin', 'adminfeedback4u@feedback4u.it', '$2y$10$E9cVzZATeBuimAIz1UnwmeMESl0wrjEoWAURqL9uiJYB3TfnqfFMu', 1);
/* password è feedback4upassword */

DROP TABLE IF EXISTS `votes`;
CREATE TABLE `votes` (
  `idVote` int NOT NULL AUTO_INCREMENT,
  `vote` int DEFAULT NULL,
  `idUser` int DEFAULT NULL,
  `idSubject` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idVote`),
  KEY `FK_Votes_Users_idx` (`idUser`),
  KEY `FK_Votes_Subject_idx` (`idSubject`),
  CONSTRAINT `FK_Votes_Subject` FOREIGN KEY (`idSubject`) REFERENCES `subjects` (`idSubject`),
  CONSTRAINT `FK_Votes_Users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`)
);
/* insert into votes (vote, idUser, idSubject, date) values (9, 2, 1,"2023-10-23"); */

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE `feedbacks` (
  `idFeedback` int NOT NULL AUTO_INCREMENT,
  `idUser` int DEFAULT NULL,
  `idSubject` int DEFAULT NULL,
  `stars` int DEFAULT NULL,
  `message` mediumtext,
  PRIMARY KEY (`idFeedback`),
  KEY `FK_Feedback_Users_idx` (`idUser`),
  KEY `FK_Feedback_Subject_idx` (`idSubject`),
  CONSTRAINT `FK_Feedback_Subject` FOREIGN KEY (`idSubject`) REFERENCES `subjects` (`idSubject`),
  CONSTRAINT `FK_Feedback_Users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`)
);