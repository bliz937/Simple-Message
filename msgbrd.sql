-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema msgbrd
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `msgbrd` ;

-- -----------------------------------------------------
-- Schema msgbrd
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `msgbrd` DEFAULT CHARACTER SET utf8 ;
USE `msgbrd` ;

-- -----------------------------------------------------
-- Table `msgbrd`.`mb_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `msgbrd`.`mb_user` ;

CREATE TABLE IF NOT EXISTS `msgbrd`.`mb_user` (
  `usr_ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usr_Name` VARCHAR(255) NOT NULL,
  `usr_Pass` VARCHAR(32) NOT NULL,
  `usr_SeshID` VARCHAR(32) NULL DEFAULT NULL,
  PRIMARY KEY (`usr_ID`),
  UNIQUE INDEX `usr_Name_UNIQUE` (`usr_Name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `msgbrd`.`mb_posts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `msgbrd`.`mb_posts` ;

CREATE TABLE IF NOT EXISTS `msgbrd`.`mb_posts` (
  `pst_ID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usr_ID` INT(10) UNSIGNED NOT NULL,
  `pst_Post` TEXT NOT NULL,
  `pst_Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pst_ID`),
  INDEX `pst_usr_ID_fk_idx` (`usr_ID` ASC),
  CONSTRAINT `pst_usr_ID_fk`
    FOREIGN KEY (`usr_ID`)
    REFERENCES `msgbrd`.`mb_user` (`usr_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
