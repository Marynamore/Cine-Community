-- MySQL Script generated by MySQL Workbench
-- Fri May 19 14:39:30 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cine_community
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `cine_community` ;

-- -----------------------------------------------------
-- Schema cine_community
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cine_community` DEFAULT CHARACTER SET utf8 ;
USE `cine_community` ;

-- -----------------------------------------------------
-- Table `cine_community`.`canal_filme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`canal_filme` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`canal_filme` (
  `id_canal_filme` INT(11) NOT NULL AUTO_INCREMENT,
  `canal_filme` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_canal_filme`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cine_community`.`categoria_filme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`categoria_filme` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`categoria_filme` (
  `id_categoria_filme` INT(11) NOT NULL AUTO_INCREMENT,
  `categoria_filme` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categoria_filme`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cine_community`.`perfil_usu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`perfil_usu` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`perfil_usu` (
  `id_perfil` INT NOT NULL AUTO_INCREMENT,
  `perfil_usu` VARCHAR(45) NOT NULL COMMENT 'administrador, moderador, colecionador',
  PRIMARY KEY (`id_perfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cine_community`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`usuario` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_usu` VARCHAR(100) NOT NULL,
  `nickname_usu` VARCHAR(100) NULL DEFAULT NULL,
  `dt_de_nasci_usu` DATE NULL DEFAULT NULL,
  `genero_usu` ENUM('masculino', 'feminino', 'naoBinario', 'naoDeclarar') NOT NULL COMMENT 'masculino, feminino, naoBinario, naoDeclarar',
  `email_usu` VARCHAR(100) NOT NULL,
  `senha_usu` VARCHAR(60) NOT NULL,
  `situacao_usu` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Ativo, Inativo ou Bloqueado\n',
  `foto_usu` VARCHAR(500) NULL DEFAULT NULL,
  `id_perfil` INT NOT NULL,
  PRIMARY KEY (`id_usuario`, `id_perfil`),
  INDEX `fk_usuario_perfil_usu1_idx` (`id_perfil` ASC),
  CONSTRAINT `fk_usuario_perfil_usu1`
    FOREIGN KEY (`id_perfil`)
    REFERENCES `cine_community`.`perfil_usu` (`id_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cine_community`.`favorito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`favorito` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`favorito` (
  `id_favorito` INT(11) NOT NULL AUTO_INCREMENT,
  `favorito` TINYINT(2) NULL DEFAULT NULL COMMENT 'inativo\nativo',
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_favorito`, `id_usuario`),
  INDEX `fk_favorito_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_favorito_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `cine_community`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cine_community`.`filme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`filme` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`filme` (
  `id_filme` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_filme` VARCHAR(80) NOT NULL,
  `dt_de_lancamento_filme` DATE NULL DEFAULT NULL,
  `duracao_filme` TIME NULL DEFAULT NULL,
  `sinopse_filme` VARCHAR(250) NOT NULL,
  `classificacao_filme` VARCHAR(50) NOT NULL,
  `capa_filme` VARCHAR(50) NOT NULL,
  `trailer_filme` VARCHAR(50) NULL DEFAULT NULL,
  `id_usuario` INT(11) NOT NULL,
  `id_categoria_filme` INT(11) NOT NULL,
  `id_canal_filme` INT(11) NOT NULL,
  PRIMARY KEY (`id_filme`, `id_usuario`, `id_categoria_filme`, `id_canal_filme`),
  INDEX `fk_filme_usuario1_idx` (`id_usuario` ASC),
  INDEX `fk_filme_categoria_filme1_idx` (`id_categoria_filme` ASC),
  INDEX `fk_filme_canal_filme1_idx` (`id_canal_filme` ASC),
  CONSTRAINT `fk_filme_canal_filme1`
    FOREIGN KEY (`id_canal_filme`)
    REFERENCES `cine_community`.`canal_filme` (`id_canal_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_filme_categoria_filme1`
    FOREIGN KEY (`id_categoria_filme`)
    REFERENCES `cine_community`.`categoria_filme` (`id_categoria_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_filme_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `cine_community`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5;


-- -----------------------------------------------------
-- Table `cine_community`.`filme_has_favorito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`filme_has_favorito` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`filme_has_favorito` (
  `id_filme` INT(11) NOT NULL AUTO_INCREMENT,
  `id_favorito` INT(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_filme`, `id_favorito`, `id_usuario`),
  INDEX `fk_filme_has_favorito_favorito1_idx` (`id_favorito` ASC, `id_usuario` ASC),
  INDEX `fk_filme_has_favorito_filme1_idx` (`id_filme` ASC),
  CONSTRAINT `fk_filme_has_favorito_favorito1`
    FOREIGN KEY (`id_favorito` , `id_usuario`)
    REFERENCES `cine_community`.`favorito` (`id_favorito` , `id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_filme_has_favorito_filme1`
    FOREIGN KEY (`id_filme`)
    REFERENCES `cine_community`.`filme` (`id_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = big5;


-- -----------------------------------------------------
-- Table `cine_community`.`resenha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`resenha` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`resenha` (
  `id_resenha` INT(11) NOT NULL AUTO_INCREMENT,
  `avaliacao_res` VARCHAR(50) NULL DEFAULT NULL,
  `titulo_res` VARCHAR(45) NULL DEFAULT NULL,
  `descricao_res` VARCHAR(1500) NULL DEFAULT NULL,
  `dt_hora_res` TIMESTAMP NULL DEFAULT NULL,
  `denuncia_res` VARCHAR(50) NULL DEFAULT NULL,
  `situacao_res` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ativo, inativo ou bloqueado\n',
  `id_filme` INT(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_resenha`, `id_filme`, `id_usuario`),
  INDEX `fk_resenha_filme1_idx` (`id_filme` ASC),
  INDEX `fk_resenha_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_resenha_filme1`
    FOREIGN KEY (`id_filme`)
    REFERENCES `cine_community`.`filme` (`id_filme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_resenha_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `cine_community`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cine_community`.`categoria_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`categoria_item` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`categoria_item` (
  `id_categoria_item` INT NOT NULL AUTO_INCREMENT,
  `categoria_item` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categoria_item`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cine_community`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`item` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`item` (
  `id_item` INT NOT NULL AUTO_INCREMENT,
  `nome_item` VARCHAR(50) NOT NULL,
  `descricao_item` VARCHAR(45) NOT NULL,
  `preco_item` VARCHAR(45) NOT NULL,
  `foto_item` VARCHAR(45) NOT NULL,
  `total_item` VARCHAR(45) NOT NULL,
  `id_categoria_item` INT NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_item`, `id_categoria_item`, `id_usuario`),
  INDEX `fk_item_categoria_item1_idx` (`id_categoria_item` ASC),
  INDEX `fk_item_usuario1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_item_categoria_item1`
    FOREIGN KEY (`id_categoria_item`)
    REFERENCES `cine_community`.`categoria_item` (`id_categoria_item`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `cine_community`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cine_community`.`carrinho_de_compra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`carrinho_de_compra` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`carrinho_de_compra` (
  `id_carrinho_de_compra` INT NOT NULL AUTO_INCREMENT,
  `quantidade_compra` VARCHAR(2) NOT NULL,
  `dt_e_hora` TIMESTAMP NOT NULL,
  `id_item` INT NOT NULL,
  `id_categoria_item` INT NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_carrinho_de_compra`, `id_item`, `id_categoria_item`, `id_usuario`),
  INDEX `fk_carrinho_de_compra_item1_idx` (`id_item` ASC, `id_categoria_item` ASC, `id_usuario` ASC),
  CONSTRAINT `fk_carrinho_de_compra_item1`
    FOREIGN KEY (`id_item` , `id_categoria_item` , `id_usuario`)
    REFERENCES `cine_community`.`item` (`id_item` , `id_categoria_item` , `id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cine_community`.`transacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cine_community`.`transacao` ;

CREATE TABLE IF NOT EXISTS `cine_community`.`transacao` (
  `id_transacao` INT NOT NULL AUTO_INCREMENT,
  `tipo_transacao` ENUM('compra', 'venda', 'troca') NOT NULL,
  `dt_e_hora` TIMESTAMP NOT NULL,
  `status_transacao` ENUM('pendente', 'concluida', 'cancelada') NOT NULL,
  `valor_total` VARCHAR(45) NOT NULL,
  `id_carrinho_de_compra` INT NOT NULL,
  `id_item` INT NOT NULL,
  `id_categoria_item` INT NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_transacao`, `id_carrinho_de_compra`, `id_item`, `id_categoria_item`, `id_usuario`),
  INDEX `fk_transacao_carrinho_de_compra1_idx` (`id_carrinho_de_compra` ASC, `id_item` ASC, `id_categoria_item` ASC, `id_usuario` ASC),
  CONSTRAINT `fk_transacao_carrinho_de_compra1`
    FOREIGN KEY (`id_carrinho_de_compra` , `id_item` , `id_categoria_item` , `id_usuario`)
    REFERENCES `cine_community`.`carrinho_de_compra` (`id_carrinho_de_compra` , `id_item` , `id_categoria_item` , `id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
