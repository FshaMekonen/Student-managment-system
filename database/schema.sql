-- Student Information Management System (SIMS)
-- Database schema extracted from the PHP application
-- Database name used by connection.php: project

CREATE DATABASE IF NOT EXISTS `project`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `project`;

-- --------------------------------------------------------
-- Admin accounts
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `fullname` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`adminid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Head of Department accounts
-- Table name in code: headde
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `headde` (
  `headid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `department` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`headid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Teacher accounts
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacherid` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `department` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`teacherid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Student accounts
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `student` (
  `studentid` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `department` VARCHAR(100) NOT NULL,
  `year` INT NOT NULL,
  PRIMARY KEY (`studentid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Course catalog
-- Used by register_course.php, entry_grade.php, view_courses.php
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `courses` (
  `courseid` INT NOT NULL AUTO_INCREMENT,
  `coursename` VARCHAR(100) NOT NULL,
  `coursecode` VARCHAR(20) DEFAULT NULL,
  `year` INT NOT NULL,
  `semester` INT NOT NULL,
  `credithour` INT NOT NULL DEFAULT 3,
  PRIMARY KEY (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Student grades
-- Status values used in code:
-- Pending, Submitted, Submitted_to_HOD, Approved, Rejected
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `grades` (
  `gradeid` INT NOT NULL AUTO_INCREMENT,
  `studentid` INT NOT NULL,
  `courseid` INT NOT NULL,
  `assessment` INT NOT NULL DEFAULT 0,
  `quiz` INT NOT NULL DEFAULT 0,
  `final_exam` INT NOT NULL DEFAULT 0,
  `total` INT NOT NULL DEFAULT 0,
  `grade` VARCHAR(2) NOT NULL,
  `status` VARCHAR(30) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`gradeid`),
  KEY `studentid` (`studentid`),
  KEY `courseid` (`courseid`),
  CONSTRAINT `grades_student_fk` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE,
  CONSTRAINT `grades_course_fk` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Student course registrations
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `student_courses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `studentid` INT NOT NULL,
  `courseid` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_course_unique` (`studentid`, `courseid`),
  KEY `courseid` (`courseid`),
  CONSTRAINT `student_courses_student_fk` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`) ON DELETE CASCADE,
  CONSTRAINT `student_courses_course_fk` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Teacher course assignments
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `teacher_course` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `teacherid` INT NOT NULL,
  `courseid` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teacher_course_unique` (`teacherid`, `courseid`),
  KEY `courseid` (`courseid`),
  CONSTRAINT `teacher_course_teacher_fk` FOREIGN KEY (`teacherid`) REFERENCES `teacher` (`teacherid`) ON DELETE CASCADE,
  CONSTRAINT `teacher_course_course_fk` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
