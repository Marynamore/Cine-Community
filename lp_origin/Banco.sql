-- MySQL Script generated by MySQL Workbench
-- Mon Apr 17 15:11:44 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema resenha_de_filme
-- -----------------------------------------------------

DROP SCHEMA IF EXISTS `resenha_de_filme` ;

-- -----------------------------------------------------
-- Schema resenha_de_filme
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `resenha_de_filme` DEFAULT CHARACTER SET utf8 ;
USE `resenha_de_filme` ;

-- -----------------------------------------------------
-- Table `resenha_de_filme`.`filme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenha_de_filme`.`filme` ;

CREATE TABLE IF NOT EXISTS `resenha_de_filme`.`filme` (
  `id_filme` INT NOT NULL AUTO_INCREMENT,
  `nome_filme` VARCHAR(80) NOT NULL,
  `dt_de_lancamento_filme` DATE NULL,
  `duracao_filme` TIME NULL,
  `sinopse_filme` VARCHAR(250) NOT NULL,
  `genero_filme` VARCHAR(50) NOT NULL,
  `classificacao_filme` VARCHAR(50) NOT NULL,
  `capa_filme` VARCHAR(50) NOT NULL,
  `trailer_filme` VARCHAR(50) NULL DEFAULT NULL,
  `canal_filme` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_filme`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5;


-- -----------------------------------------------------
-- Table `resenha_de_filme`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenha_de_filme`.`usuario` ;

CREATE TABLE IF NOT EXISTS `resenha_de_filme`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usu` VARCHAR(100) NOT NULL,
  `nickname_usu` VARCHAR(100) NULL DEFAULT NULL,
  `genero_usu` ENUM('masculino', 'feminino') NOT NULL,
  `dt_de_nasci_usu` DATE NULL DEFAULT NULL,
  `email_usu` VARCHAR(100) NOT NULL,
  `senha_usu` VARCHAR(60) NOT NULL,
  `situacao_usu` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Ativo, Inativo ou bloqueado\n',
  `perfil_usu` VARCHAR(15) NULL DEFAULT 'usuario' COMMENT 'usuario, administrador, moderador',
  `foto_usu` VARCHAR(500) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resenha_de_filme`.`favorito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenha_de_filme`.`favorito` ;

CREATE TABLE IF NOT EXISTS `resenha_de_filme`.`favorito` (
  `id_favorito` INT NOT NULL AUTO_INCREMENT,
  `favorito` TINYINT(2) NULL DEFAULT NULL COMMENT 'inativo\nativo',
  `usuario_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_favorito`, `usuario_id_usuario`),
  INDEX `fk_favorito_usuario1_idx` (`usuario_id_usuario` ASC),
  CONSTRAINT `fk_favorito_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `resenha_de_filme`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resenha_de_filme`.`resenha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenha_de_filme`.`resenha` ;

CREATE TABLE IF NOT EXISTS `resenha_de_filme`.`resenha` (
  `id_resenha` INT NOT NULL AUTO_INCREMENT,
  `avaliacao_res` VARCHAR(50) NULL DEFAULT NULL,
  `descricao_res` VARCHAR(1500) NULL DEFAULT NULL,
  `dt_hora_res` TIMESTAMP NULL DEFAULT NULL,
  `denuncia_res` VARCHAR(50) NULL DEFAULT NULL,
  `situacao_res` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ativo, inativo ou bloqueado\n',
  `filme_id_filme` INT NOT NULL,
  PRIMARY KEY (`id_resenha`, `filme_id_filme`),
  INDEX `fk_resenha_filme1_idx` (`filme_id_filme` ASC),
  CONSTRAINT `fk_resenha_filme1`
    FOREIGN KEY (`filme_id_filme`)
    REFERENCES `resenha_de_filme`.`filme` (`id_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resenha_de_filme`.`usuario_has_resenha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenha_de_filme`.`usuario_has_resenha` ;

CREATE TABLE IF NOT EXISTS `resenha_de_filme`.`usuario_has_resenha` (
  `usuario_id_usuario` INT NOT NULL,
  `resenha_id_resenha` INT NOT NULL,
  `resenha_filme_id_filme` INT NOT NULL,
  PRIMARY KEY (`usuario_id_usuario`, `resenha_id_resenha`, `resenha_filme_id_filme`),
  INDEX `fk_usuario_has_resenha_resenha1_idx` (`resenha_id_resenha` ASC, `resenha_filme_id_filme` ASC),
  INDEX `fk_usuario_has_resenha_usuario1_idx` (`usuario_id_usuario` ASC),
  CONSTRAINT `fk_usuario_has_resenha_usuario1`
    FOREIGN KEY (`usuario_id_usuario`)
    REFERENCES `resenha_de_filme`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_resenha_resenha1`
    FOREIGN KEY (`resenha_id_resenha` , `resenha_filme_id_filme`)
    REFERENCES `resenha_de_filme`.`resenha` (`id_resenha` , `filme_id_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `resenha_de_filme`.`favorito_has_filme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `resenha_de_filme`.`favorito_has_filme` ;

CREATE TABLE IF NOT EXISTS `resenha_de_filme`.`favorito_has_filme` (
  `favorito_id_favorito` INT NOT NULL,
  `favorito_usuario_id_usuario` INT NOT NULL,
  `filme_id_filme` INT NOT NULL,
  PRIMARY KEY (`favorito_id_favorito`, `favorito_usuario_id_usuario`, `filme_id_filme`),
  INDEX `fk_favorito_has_filme_filme1_idx` (`filme_id_filme` ASC),
  INDEX `fk_favorito_has_filme_favorito1_idx` (`favorito_id_favorito` ASC, `favorito_usuario_id_usuario` ASC),
  CONSTRAINT `fk_favorito_has_filme_favorito1`
    FOREIGN KEY (`favorito_id_favorito` , `favorito_usuario_id_usuario`)
    REFERENCES `resenha_de_filme`.`favorito` (`id_favorito` , `usuario_id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_favorito_has_filme_filme1`
    FOREIGN KEY (`filme_id_filme`)
    REFERENCES `resenha_de_filme`.`filme` (`id_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
