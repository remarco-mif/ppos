SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `PPOS` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `PPOS` ;

-- -----------------------------------------------------
-- Table `PPOS`.`ParamosPriemoniuKryptys`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`ParamosPriemoniuKryptys` (
  `idParamosPriemoniuKryptys` INT NOT NULL AUTO_INCREMENT ,
  `Pavadinimas` TEXT NOT NULL ,
  PRIMARY KEY (`idParamosPriemoniuKryptys`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`ParamosPriemones`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`ParamosPriemones` (
  `idParamosPriemoniuKryptys` INT NOT NULL AUTO_INCREMENT ,
  `Kodas` VARCHAR(45) NOT NULL ,
  `Pavadinimas` TEXT NOT NULL ,
  `Kryptis` INT NOT NULL ,
  PRIMARY KEY (`idParamosPriemoniuKryptys`) ,
  UNIQUE INDEX `Kodas_UNIQUE` (`Kodas` ASC) ,
  INDEX `fk_ParamosPriemones_ParamosPriemoniuKryptys` (`Kryptis` ASC) ,
  CONSTRAINT `fk_ParamosPriemones_ParamosPriemoniuKryptys`
    FOREIGN KEY (`Kryptis` )
    REFERENCES `PPOS`.`ParamosPriemoniuKryptys` (`idParamosPriemoniuKryptys` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`Padaliniai`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`Padaliniai` (
  `idPadaliniai` INT NOT NULL AUTO_INCREMENT ,
  `Kodas` VARCHAR(45) NOT NULL ,
  `Pavadinimas` TEXT NOT NULL ,
  PRIMARY KEY (`idPadaliniai`) ,
  UNIQUE INDEX `Kodas_UNIQUE` (`Kodas` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`IS`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`IS` (
  `idIS` INT NOT NULL AUTO_INCREMENT ,
  `Kodas` VARCHAR(45) NOT NULL ,
  `Pavadinimas` TEXT NOT NULL ,
  PRIMARY KEY (`idIS`) ,
  UNIQUE INDEX `Kodas_UNIQUE` (`Kodas` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`IS_Padaliniai`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`IS_Padaliniai` (
  `Padalinys` INT NOT NULL ,
  `IS` INT NOT NULL ,
  INDEX `fk_IS_Padaliniai_Padaliniai1` (`Padalinys` ASC) ,
  INDEX `fk_IS_Padaliniai_IS1` (`IS` ASC) ,
  PRIMARY KEY (`Padalinys`, `IS`) ,
  CONSTRAINT `fk_IS_Padaliniai_Padaliniai1`
    FOREIGN KEY (`Padalinys` )
    REFERENCES `PPOS`.`Padaliniai` (`idPadaliniai` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_IS_Padaliniai_IS1`
    FOREIGN KEY (`IS` )
    REFERENCES `PPOS`.`IS` (`idIS` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`ParamosAdministravimas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`ParamosAdministravimas` (
  `ParamosPriemone` INT NOT NULL ,
  `Padalinys` INT NOT NULL ,
  `Valandos` INT NOT NULL ,
  INDEX `fk_ParamosAdministravimas_ParamosPriemones1` (`ParamosPriemone` ASC) ,
  INDEX `fk_ParamosAdministravimas_Padaliniai1` (`Padalinys` ASC) ,
  PRIMARY KEY (`ParamosPriemone`, `Padalinys`) ,
  CONSTRAINT `fk_ParamosAdministravimas_ParamosPriemones1`
    FOREIGN KEY (`ParamosPriemone` )
    REFERENCES `PPOS`.`ParamosPriemones` (`idParamosPriemoniuKryptys` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ParamosAdministravimas_Padaliniai1`
    FOREIGN KEY (`Padalinys` )
    REFERENCES `PPOS`.`Padaliniai` (`idPadaliniai` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`ParamosKiekiai`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`ParamosKiekiai` (
  `idParamosKiekiai` INT NOT NULL AUTO_INCREMENT ,
  `ParamosPriemone` INT NOT NULL ,
  `Nuo` DATE NOT NULL ,
  `Iki` DATE NOT NULL ,
  `ParaiskuKiekis` INT NOT NULL ,
  PRIMARY KEY (`idParamosKiekiai`) ,
  INDEX `fk_ParamosKiekiai_ParamosPriemones1` (`ParamosPriemone` ASC) ,
  CONSTRAINT `fk_ParamosKiekiai_ParamosPriemones1`
    FOREIGN KEY (`ParamosPriemone` )
    REFERENCES `PPOS`.`ParamosPriemones` (`idParamosPriemoniuKryptys` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
