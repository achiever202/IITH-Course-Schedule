-- MySQL Script generated by MySQL Workbench
-- 03/24/15 00:20:20
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema iithcourses
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema iithcourses
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `iithcourses` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `iithcourses` ;

-- -----------------------------------------------------
-- Table `iithcourses`.`Instructor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Instructor` (
  `Instructor_ID` INT NOT NULL,
  `Instructor_Name` VARCHAR(45) NOT NULL,
  `Instructor_Credentials` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Instructor_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iithcourses`.`Department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Department` (
  `Short_Name` CHAR(5) NOT NULL,
  `Full_Name` VARCHAR(45) NOT NULL,
  `Website` VARCHAR(60) NULL,
  PRIMARY KEY (`Short_Name`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iithcourses`.`Instructor_has_Department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Instructor_has_Department` (
  `Instructor_Instructor_ID` INT NOT NULL,
  `Department_Short_Name` CHAR(5) NOT NULL,
  PRIMARY KEY (`Instructor_Instructor_ID`, `Department_Short_Name`),
  INDEX `fk_Instructor_has_Department_Department1_idx` (`Department_Short_Name` ASC),
  INDEX `fk_Instructor_has_Department_Instructor_idx` (`Instructor_Instructor_ID` ASC),
  CONSTRAINT `fk_Instructor_has_Department_Instructor`
    FOREIGN KEY (`Instructor_Instructor_ID`)
    REFERENCES `iithcourses`.`Instructor` (`Instructor_ID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Instructor_has_Department_Department1`
    FOREIGN KEY (`Department_Short_Name`)
    REFERENCES `iithcourses`.`Department` (`Short_Name`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iithcourses`.`Courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Courses` (
  `Course_ID` CHAR(6) NOT NULL,
  `Course_Title` VARCHAR(45) NOT NULL,
  `Credits` VARCHAR(45) NULL,
  PRIMARY KEY (`Course_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iithcourses`.`Department_has_Courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Department_has_Courses` (
  `Department_Short_Name` CHAR(5) NOT NULL,
  `Courses_Course_ID` CHAR(6) NOT NULL,
  PRIMARY KEY (`Department_Short_Name`, `Courses_Course_ID`),
  INDEX `fk_Department_has_Courses_Courses1_idx` (`Courses_Course_ID` ASC),
  INDEX `fk_Department_has_Courses_Department1_idx` (`Department_Short_Name` ASC),
  CONSTRAINT `fk_Department_has_Courses_Department1`
    FOREIGN KEY (`Department_Short_Name`)
    REFERENCES `iithcourses`.`Department` (`Short_Name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Department_has_Courses_Courses1`
    FOREIGN KEY (`Courses_Course_ID`)
    REFERENCES `iithcourses`.`Courses` (`Course_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iithcourses`.`Offered_Courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Offered_Courses` (
  `ID` INT NOT NULL,
  `Semester` VARCHAR(10) NOT NULL,
  `Year` INT NOT NULL,
  `Start_Date` DATE NOT NULL,
  `End_Date` DATE NOT NULL,
  `Num_Student` INT NOT NULL,
  `Courses_Course_ID` CHAR(6) NOT NULL,
  `Instructor_Instructor_ID` INT NOT NULL,
  PRIMARY KEY (`ID`, `Courses_Course_ID`, `Instructor_Instructor_ID`),
  INDEX `fk_Offered_Courses_Courses1_idx` (`Courses_Course_ID` ASC),
  INDEX `fk_Offered_Courses_Instructor1_idx` (`Instructor_Instructor_ID` ASC),
  CONSTRAINT `fk_Offered_Courses_Courses1`
    FOREIGN KEY (`Courses_Course_ID`)
    REFERENCES `iithcourses`.`Courses` (`Course_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Offered_Courses_Instructor1`
    FOREIGN KEY (`Instructor_Instructor_ID`)
    REFERENCES `iithcourses`.`Instructor` (`Instructor_ID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `iithcourses`.`Schedule`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `iithcourses`.`Schedule` (
  `Room_Number` INT NOT NULL,
  `Slot` INT NOT NULL,
  `Day_Of_Week` INT NOT NULL,
  `Offered_Courses_ID` INT NOT NULL,
  `Offered_Courses_Courses_Course_ID` CHAR(6) NOT NULL,
  `Offered_Courses_Instructor_Instructor_ID` INT NOT NULL,
  PRIMARY KEY (`Room_Number`, `Slot`, `Day_Of_Week`, `Offered_Courses_ID`, `Offered_Courses_Courses_Course_ID`, `Offered_Courses_Instructor_Instructor_ID`),
  INDEX `fk_Schedule_Offered_Courses1_idx` (`Offered_Courses_ID` ASC, `Offered_Courses_Courses_Course_ID` ASC, `Offered_Courses_Instructor_Instructor_ID` ASC),
  CONSTRAINT `fk_Schedule_Offered_Courses1`
    FOREIGN KEY (`Offered_Courses_ID` , `Offered_Courses_Courses_Course_ID` , `Offered_Courses_Instructor_Instructor_ID`)
    REFERENCES `iithcourses`.`Offered_Courses` (`ID` , `Courses_Course_ID` , `Instructor_Instructor_ID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
