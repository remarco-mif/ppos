SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `PPOS` DEFAULT CHARACTER SET utf8 COLLATE utf8_lithuanian_ci ;
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
  `idParamosPriemones` INT NOT NULL AUTO_INCREMENT ,
  `Kodas` VARCHAR(45) NOT NULL ,
  `Pavadinimas` TEXT NOT NULL ,
  `Kryptis` INT NOT NULL ,
  PRIMARY KEY (`idParamosPriemones`) ,
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
  `Valandos` DECIMAL(11,1) NOT NULL ,
  INDEX `fk_ParamosAdministravimas_ParamosPriemones1` (`ParamosPriemone` ASC) ,
  INDEX `fk_ParamosAdministravimas_Padaliniai1` (`Padalinys` ASC) ,
  PRIMARY KEY (`ParamosPriemone`, `Padalinys`) ,
  CONSTRAINT `fk_ParamosAdministravimas_ParamosPriemones1`
    FOREIGN KEY (`ParamosPriemone` )
    REFERENCES `PPOS`.`ParamosPriemones` (`idParamosPriemones` )
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
    REFERENCES `PPOS`.`ParamosPriemones` (`idParamosPriemones` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PPOS`.`User`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `PPOS`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT ,
  `Username` VARCHAR(32) NOT NULL ,
  `Password` VARCHAR(256) NOT NULL ,
  `Admin` TINYINT(1)  NOT NULL ,
  PRIMARY KEY (`idUser`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `PPOS`.`PadaliniuParaiskuKiekis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PPOS`.`PadaliniuParaiskuKiekis` (`Nuo` INT, `idPadaliniai` INT, `Kodas` INT, `Pavadinimas` INT, `"Paraiskos"` INT);

-- -----------------------------------------------------
-- Placeholder table for view `PPOS`.`IsParaiskuKiekis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PPOS`.`IsParaiskuKiekis` (`Nuo` INT, `Kodas` INT, `Pavadinimas` INT, `"Paraiskos"` INT);

-- -----------------------------------------------------
-- Placeholder table for view `PPOS`.`PadaliniuValanduKiekis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PPOS`.`PadaliniuValanduKiekis` (`Nuo` INT, `idPadaliniai` INT, `Kodas` INT, `Pavadinimas` INT, `"Valandos"` INT);

-- -----------------------------------------------------
-- Placeholder table for view `PPOS`.`IsValanduKiekis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PPOS`.`IsValanduKiekis` (`Nuo` INT, `Kodas` INT, `Pavadinimas` INT, `"Valandos"` INT);

-- -----------------------------------------------------
-- View `PPOS`.`PadaliniuParaiskuKiekis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PPOS`.`PadaliniuParaiskuKiekis`;
USE `PPOS`;
CREATE  OR REPLACE VIEW `PPOS`.`PadaliniuParaiskuKiekis` AS
SELECT ParamosKiekiai.Nuo, Padaliniai.idPadaliniai, Padaliniai.Kodas, Padaliniai.Pavadinimas, SUM(ParamosKiekiai.ParaiskuKiekis) AS "Paraiskos"
    FROM ParamosKiekiai, ParamosAdministravimas, Padaliniai
    WHERE ParamosKiekiai.ParamosPriemone = ParamosAdministravimas.ParamosPriemone
          AND Padaliniai.idPadaliniai = ParamosAdministravimas.Padalinys
    GROUP BY ParamosKiekiai.Nuo, ParamosAdministravimas.Padalinys;

-- -----------------------------------------------------
-- View `PPOS`.`IsParaiskuKiekis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PPOS`.`IsParaiskuKiekis`;
USE `PPOS`;
CREATE  OR REPLACE VIEW `PPOS`.`IsParaiskuKiekis` AS
SELECT PadaliniuParaiskuKiekis.Nuo, `IS`.Kodas, `IS`.Pavadinimas, SUM(PadaliniuParaiskuKiekis.Paraiskos) AS "Paraiskos"
    FROM PadaliniuParaiskuKiekis, IS_Padaliniai, `IS`
    WHERE PadaliniuParaiskuKiekis.idPadaliniai = IS_Padaliniai.Padalinys AND IS_Padaliniai.IS = `IS`.idIS
    GROUP BY PadaliniuParaiskuKiekis.Nuo, IS_Padaliniai.IS;

-- -----------------------------------------------------
-- View `PPOS`.`PadaliniuValanduKiekis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PPOS`.`PadaliniuValanduKiekis`;
USE `PPOS`;
CREATE  OR REPLACE VIEW `PPOS`.`PadaliniuValanduKiekis` AS
SELECT ParamosKiekiai.Nuo, Padaliniai.idPadaliniai, Padaliniai.Kodas, Padaliniai.Pavadinimas, SUM((ParamosAdministravimas.Valandos * ParamosKiekiai.ParaiskuKiekis)) AS "Valandos"
    FROM ParamosKiekiai, ParamosAdministravimas, Padaliniai
    WHERE ParamosKiekiai.ParamosPriemone = ParamosAdministravimas.ParamosPriemone
          AND Padaliniai.idPadaliniai = ParamosAdministravimas.Padalinys
    GROUP BY ParamosKiekiai.Nuo, ParamosAdministravimas.Padalinys;

-- -----------------------------------------------------
-- View `PPOS`.`IsValanduKiekis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PPOS`.`IsValanduKiekis`;
USE `PPOS`;
CREATE  OR REPLACE VIEW `PPOS`.`IsValanduKiekis` AS
SELECT PadaliniuValanduKiekis.Nuo, `IS`.Kodas, `IS`.Pavadinimas, SUM(PadaliniuValanduKiekis.Valandos) AS "Valandos"
    FROM PadaliniuValanduKiekis, IS_Padaliniai, `IS`
    WHERE PadaliniuValanduKiekis.idPadaliniai = IS_Padaliniai.Padalinys AND IS_Padaliniai.IS = `IS`.idIS
    GROUP BY PadaliniuValanduKiekis.Nuo, IS_Padaliniai.IS;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `PPOS`.`User`
-- -----------------------------------------------------
START TRANSACTION;
USE `PPOS`;
INSERT INTO `PPOS`.`User` (`idUser`, `Username`, `Password`, `Admin`) VALUES (0, 'admin', 'admin', 1);

COMMIT;
