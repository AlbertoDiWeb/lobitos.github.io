-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema guarderia_database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `guarderia_database` DEFAULT CHARACTER SET utf8mb4 collate utf8mb4_spanish2_ci;
USE `guarderia_database`;

-- -----------------------------------------------------
-- Table `guarderia_database`.`aulas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`aulas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `color` VARCHAR(45) NOT NULL,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `color_UNIQUE` (`color` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guarderia_database`.`cuidadores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`cuidadores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dni` CHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `primerApellido` VARCHAR(45) NULL,
  `segundoApellido` VARCHAR(45) NULL,
  `fecha_nacimiento` DATE,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guarderia_database`.`matricula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`matricula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cod_matricula` VARCHAR(45) NULL,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cod_matricula_UNIQUE` (`cod_matricula` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guarderia_database`.`niños`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`niños` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idMatricula` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `primerApellido` VARCHAR(45) NULL,
  `segundoApellido` VARCHAR(45) NULL,
  `fechaNacimiento` DATE,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  `idCuidadores` INT NOT NULL,
  `idTutores` INT NOT NULL,
  `idAulas` INT NOT NULL,
  `colorAulas` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `idMatricula`),
  INDEX `idx_fk_niños_cuidadores` (`idCuidadores` ASC),
  INDEX `idx_fk_niños_matricula` (`idMatricula` ASC),
  INDEX `idx_fk_niños_tutores` (`idTutores` ASC),
  INDEX `idx_fk_niños_aulas` (`idAulas` ASC),
  CONSTRAINT `fk_niños_cuidadores`
    FOREIGN KEY (`idCuidadores`)
    REFERENCES `guarderia_database`.`cuidadores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_niños_matricula`
    FOREIGN KEY (`idMatricula`)
    REFERENCES `guarderia_database`.`matricula` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_niños_tutores`
    FOREIGN KEY (`idTutores`)
    REFERENCES `guarderia_database`.`tutores` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_niños_aulas`
    FOREIGN KEY (`idAulas`)
    REFERENCES `guarderia_database`.`aulas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guarderia_database`.`trabajadoresLobitos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`trabajadoresLobitos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(45) NULL,
  `contraseña` VARCHAR(45) NULL,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guarderia_database`.`tutores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`tutores` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dni` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `primerApellido` VARCHAR(45) NULL,
  `segundoApellido` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `cp` INT NULL,
  `pais` VARCHAR(45) NULL,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `guarderia_database`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `guarderia_database`.`usuarios` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `primerApellido` VARCHAR(45) NOT NULL,
  `segundoApellido` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `contraseña` VARCHAR(45) NOT NULL,
  `usuarioCreacion` VARCHAR(45),
  `fechaCreacion` DATETIME NOT NULL DEFAULT NOW(),
  `usuarioModificacion` VARCHAR(45),
  `fechaModificacion` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

USE `guarderia_database`;

DELIMITER $$
USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`aulas_BEFORE_INSERT` BEFORE INSERT ON `aulas` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`aulas_BEFORE_UPDATE` BEFORE UPDATE ON `aulas` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`cuidadores_BEFORE_INSERT` BEFORE INSERT ON `cuidadores` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`cuidadores_BEFORE_UPDATE` BEFORE UPDATE ON `cuidadores` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`matricula_BEFORE_INSERT` BEFORE INSERT ON `matricula` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`matricula_BEFORE_UPDATE` BEFORE UPDATE ON `matricula` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`niños_BEFORE_INSERT` BEFORE INSERT ON `niños` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`niños_BEFORE_UPDATE` BEFORE UPDATE ON `niños` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`trabajadoresLobitos_BEFORE_INSERT` BEFORE INSERT ON `trabajadoresLobitos` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`trabajadoresLobitos_BEFORE_UPDATE` BEFORE UPDATE ON `trabajadoresLobitos` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`tutores_BEFORE_INSERT` BEFORE INSERT ON `tutores` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`tutores_BEFORE_UPDATE` BEFORE UPDATE ON `tutores` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`usuarios_BEFORE_INSERT` BEFORE INSERT ON `usuarios` FOR EACH ROW
BEGIN
set new.usuarioCreacion = user();
END$$

USE `guarderia_database`$$
CREATE DEFINER = CURRENT_USER TRIGGER `guarderia_database`.`usuarios_BEFORE_UPDATE` BEFORE UPDATE ON `usuarios` FOR EACH ROW
BEGIN
set new.usuarioModificacion = user();
END$$ 

DELIMITER ;

-- -----------------------------------------------------
-- CARGA DE DATOS
-- -----------------------------------------------------
INSERT INTO `aulas` (`color`) VALUES
('amarilla'), ('azul'), ('roja'), ('verde');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
