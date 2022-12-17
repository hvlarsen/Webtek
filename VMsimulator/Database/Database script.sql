-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema vmsimulator
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema vmsimulator
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `vmsimulator` DEFAULT CHARACTER SET utf8 ;
USE `vmsimulator` ;

-- -----------------------------------------------------
-- Table `vmsimulator`.`teams`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vmsimulator`.`teams` (
  `Team` VARCHAR(45) NOT NULL,
  `Teamname` VARCHAR(45) NULL DEFAULT NULL,
  `Groupname` VARCHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Team`),
  UNIQUE INDEX `Team_UNIQUE` (`Team` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `vmsimulator`.`matches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vmsimulator`.`matches` (
  `MatchID` INT(11) NOT NULL,
  `RoundNumber` TEXT NULL DEFAULT NULL,
  `Date` TEXT NULL DEFAULT NULL,
  `Location` TEXT NULL DEFAULT NULL,
  `Team1` VARCHAR(45) NULL DEFAULT NULL,
  `Team2` VARCHAR(45) NULL DEFAULT NULL,
  `goals1` INT(11) NULL DEFAULT NULL,
  `goals2` INT(11) NULL DEFAULT NULL,
  `winner` VARCHAR(45) NULL DEFAULT NULL,
  `loser` VARCHAR(45) NULL DEFAULT NULL,
  `played` TEXT NULL DEFAULT NULL,
  `Team1_source` VARCHAR(45) NULL DEFAULT NULL,
  `Team2_source` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`MatchID`),
  INDEX `winner_fk_idx` (`winner` ASC) VISIBLE,
  INDEX `Team1_fk_idx` (`Team1` ASC) VISIBLE,
  INDEX `Team2sdf_fk_idx` (`Team2` ASC) VISIBLE,
  INDEX `losersdk_fk_idx` (`loser` ASC) VISIBLE,
  INDEX `Team1_sourcesdf_fk_idx` (`Team1_source` ASC) VISIBLE,
  CONSTRAINT `Team1sdf_fk`
    FOREIGN KEY (`Team1`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Team2sdf_fk`
    FOREIGN KEY (`Team2`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `losersdk_fk`
    FOREIGN KEY (`loser`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `winnersdk_fk`
    FOREIGN KEY (`winner`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `vmsimulator`.`simulations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vmsimulator`.`simulations` (
  `SimulationID` INT(11) NOT NULL AUTO_INCREMENT,
  `User` VARCHAR(45) NULL DEFAULT NULL,
  `Date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`SimulationID`),
  UNIQUE INDEX `SimulationID_UNIQUE` (`SimulationID` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 457
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `vmsimulator`.`simulation_results`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vmsimulator`.`simulation_results` (
  `SimulationID` INT(11) NOT NULL,
  `MatchID` INT(11) NOT NULL,
  `RoundNumber` VARCHAR(45) NULL DEFAULT NULL,
  `Team1` VARCHAR(45) NULL DEFAULT NULL,
  `Team2` VARCHAR(45) NULL DEFAULT NULL,
  `goals1` INT(11) NULL DEFAULT NULL,
  `goals2` INT(11) NULL DEFAULT NULL,
  `winner` VARCHAR(45) NULL DEFAULT NULL,
  `loser` VARCHAR(45) NULL DEFAULT NULL,
  `played` INT(11) NULL DEFAULT NULL,
  `Team1_source` VARCHAR(45) NULL DEFAULT NULL,
  `Team2_source` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`SimulationID`, `MatchID`),
  INDEX `matchID_fk_idx` (`MatchID` ASC) VISIBLE,
  INDEX `team1_fk_idx` (`Team1` ASC) VISIBLE,
  INDEX `Team2_fk_idx` (`Team2` ASC) VISIBLE,
  INDEX `winner_fk_idx` (`winner` ASC) VISIBLE,
  INDEX `loser_fk_idx` (`loser` ASC) VISIBLE,
  CONSTRAINT `Team1_fk`
    FOREIGN KEY (`Team1`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Team2_fk`
    FOREIGN KEY (`Team2`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `loser_fk`
    FOREIGN KEY (`loser`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `matchID_fk`
    FOREIGN KEY (`MatchID`)
    REFERENCES `vmsimulator`.`matches` (`MatchID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `simulationID_fk`
    FOREIGN KEY (`SimulationID`)
    REFERENCES `vmsimulator`.`simulations` (`SimulationID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `winner_fk`
    FOREIGN KEY (`winner`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `vmsimulator`.`team_points`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vmsimulator`.`team_points` (
  `SimulationID` INT(11) NULL DEFAULT NULL,
  `Team` VARCHAR(45) NULL DEFAULT NULL,
  `Points` INT(11) NULL DEFAULT NULL,
  `Goals_for` INT(11) NULL DEFAULT NULL,
  `Goals_against` INT(11) NULL DEFAULT NULL,
  INDEX `Team_fk_idx` (`Team` ASC) VISIBLE,
  INDEX `SimID_fk_idx` (`SimulationID` ASC) VISIBLE,
  CONSTRAINT `SimID_fk`
    FOREIGN KEY (`SimulationID`)
    REFERENCES `vmsimulator`.`simulations` (`SimulationID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Team_p_fk`
    FOREIGN KEY (`Team`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `vmsimulator`.`team_strength`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `vmsimulator`.`team_strength` (
  `Team` VARCHAR(45) NOT NULL,
  `AttackPower` DOUBLE NULL DEFAULT NULL,
  `DefensePower` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`Team`),
  CONSTRAINT `Team_fk`
    FOREIGN KEY (`Team`)
    REFERENCES `vmsimulator`.`teams` (`Team`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
