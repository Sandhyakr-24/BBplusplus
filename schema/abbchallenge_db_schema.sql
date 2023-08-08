-- Last updated on 6-June-2018 -----

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `abbchmprmdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `abbchmprmdb`;

-- -----------------------------------------------------
-- Table `grade_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `grade_tbl` ;

CREATE  TABLE IF NOT EXISTS `grade_tbl` (
  `id_grade` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(30) NULL ,
  PRIMARY KEY (`id_grade`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `concept_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `concept_tbl` ;

CREATE  TABLE IF NOT EXISTS `concept_tbl` (
  `id_concept` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(512) NOT NULL,
   PRIMARY KEY (`id_concept`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `microconcept_group_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `microconcept_group_tbl` ;

CREATE  TABLE IF NOT EXISTS `microconcept_group_tbl` (
  `idmcg` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(512) NOT NULL,
  `id_concept` INT NULL ,
  PRIMARY KEY (`idmcg`) ,
  CONSTRAINT `fk_mconceptgrp`
    FOREIGN KEY (`id_concept` )
    REFERENCES `concept_tbl` (`id_concept` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `micro_concept_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `micro_concept_tbl` ;

CREATE  TABLE IF NOT EXISTS `micro_concept_tbl` (
  `id_micro_concept` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(256) NOT NULL ,
  `id_concept` INT NOT NULL ,
  `idmcg` INT NOT NULL,

  PRIMARY KEY (`id_micro_concept`) ,
  CONSTRAINT `fk_mcidmcg`
    FOREIGN KEY (`idmcg` )
    REFERENCES `microconcept_group_tbl` (`idmcg` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mcconcept`
    FOREIGN KEY (`id_concept` )
    REFERENCES `concept_tbl` (`id_concept` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE INDEX `fk_mcidmcg` ON `micro_concept_tbl` (`idmcg` ASC) ;

CREATE INDEX `fk_mcconcept` ON `micro_concept_tbl` (`id_concept` ASC) ;


-- -----------------------------------------------------
-- Table `language_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `language_tbl` ;

CREATE  TABLE IF NOT EXISTS `language_tbl` (
  `id_language` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(60) NULL ,
  PRIMARY KEY (`id_language`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `child_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `child_tbl` ;

CREATE  TABLE IF NOT EXISTS `child_tbl` (
  `id_child` INT NOT NULL AUTO_INCREMENT ,
  `child_name` VARCHAR(256) NOT NULL ,
  `deviceid` varchar(256) NOT NULL,
  `id_grade` INT NOT NULL ,
  `school_type` TINYINT(1) NOT NULL ,
  `geo` VARCHAR(256) NOT NULL ,
  `district` VARCHAR(256) NULL,
  `id_language` INT NOT NULL ,
  `organization` VARCHAR(256) NULL ,
  `avatar_pic` VARCHAR(256) NULL, /* picture filename */
  `created_datetime` datetime NOT NULL,
  PRIMARY KEY (`id_child`) ,
  KEY `child_name` (`child_name`,`deviceid`, `id_child`),
  CONSTRAINT `fk_language`
    FOREIGN KEY (`id_language` )
    REFERENCES `language_tbl` (`id_language` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
	/* Set up a unique key constraint for child name and phone number to avoid duplicate kid name for the same phone number */
ENGINE = InnoDB;

CREATE INDEX `fk_language` ON `child_tbl` (`id_language` ASC) ;

create unique index `uk_child` on `child_tbl` (`child_name`, `deviceid` ASC);

-- -----------------------------------------------------
-- Table `question_type_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `question_type_tbl` ;

CREATE TABLE IF NOT EXISTS `question_type_tbl` ( 
`id_question_type` INT NOT NULL AUTO_INCREMENT ,
`code` VARCHAR(25) NOT NULL ,  
`description` VARCHAR(256) NOT NULL , 
PRIMARY KEY (`id_question_type`)) 
ENGINE = InnoDB; 

-- -----------------------------------------------------
-- Table `question_classification_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `question_classification_tbl` ;

CREATE TABLE IF NOT EXISTS `question_classification_tbl` ( 
`id_question_classification` INT NOT NULL AUTO_INCREMENT , 
`code` VARCHAR(10)  NULL,
`description` VARCHAR(256) NOT NULL , 
PRIMARY KEY (`id_question_classification`)) 
ENGINE = InnoDB; 



-- -----------------------------------------------------
-- Table `game_master_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `game_master_tbl` ;

CREATE TABLE IF NOT EXISTS `game_master_tbl` ( 
`idg` INT NOT NULL AUTO_INCREMENT , 
`id_game` VARCHAR(100) NOT NULL ,    /* id_game to be a unique varchar instead of autoincrement integer as games can be from multiple vendors */
`game_description` VARCHAR(512) NOT NULL,
`id_grade` INT NOT NULL,
PRIMARY KEY (`idg`)) 
ENGINE = InnoDB;
CREATE INDEX `idx_game1` ON `game_master_tbl` (`id_game` ASC) ;

-- -----------------------------------------------------
-- Table `game_play_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `game_play_tbl` ;

CREATE TABLE IF NOT EXISTS `game_play_tbl` ( 
`idgp` INT NOT NULL AUTO_INCREMENT , 
`id_game_play` VARCHAR(100) NOT NULL , /* A unique 10-char idenfitifer for id_game_play. Cannot be autoincrement integer as this ID need to be dynamically created by multiple devices */
`id_game` VARCHAR(100) NOT NULL,
`id_child` INT NOT NULL,
`start_time` datetime not null,
`synced` TINYINT not null default 0,
PRIMARY KEY (`idgp`),
 CONSTRAINT `fk_child_id` 
    FOREIGN KEY (`id_child` )
    REFERENCES `child_tbl` (`id_child` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;
CREATE INDEX `idx_game2` ON `game_play_tbl` (`id_game` ASC) ;
CREATE INDEX `idx_game_play1` ON `game_play_tbl` (`id_game_play` ASC) ;

-- -----------------------------------------------------
-- Table `game_play_detail_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `game_play_detail_tbl` ;

CREATE TABLE IF NOT EXISTS `game_play_detail_tbl` ( 
`id_game_play_detail` INT NOT NULL AUTO_INCREMENT , 
`id_game_play` VARCHAR(100) NOT NULL , 
`id_child` INT NOT NULL ,
`id_question` VARCHAR(100) NOT NULL , 
/* `answer_given` VARCHAR(500) NOT NULL ,  * Not used (23/1/18). 'actual answer' given by the child. Removing this field as game will return the 'Pass' status*/ 
`date_time_submission` DATETIME NOT NULL,  /* When was the answer submitted to this question */
`time2answer` INT NOT NULL , /*time taken by the child to answer the question in seconds */ 
`pass` VARCHAR(25) NULL , /* Yes/No ('Yes' if 'given answer' and 'correct answer' are same. This comparison will be done within the game and the 'pass' status will be sent by the games ) */
`attempts` INT NULL , /* Number of attempts by the Child before the final submission */
`synced` TINYINT not null default 0,
PRIMARY KEY (`id_game_play_detail`)) 
ENGINE = InnoDB;
CREATE INDEX `idx_game_play2` ON `game_play_detail_tbl` (`id_game_play` ASC) ;
CREATE INDEX `idx_id_child1` ON `game_play_detail_tbl` (`id_child` ASC) ;
CREATE INDEX `idx_id_question1` ON `game_play_detail_tbl` (`id_question` ASC) ;

-- -----------------------------------------------------
-- Table `device_accesstoken_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `device_accesstoken_tbl` ;

CREATE TABLE IF NOT EXISTS `device_accesstoken_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_token` varchar(256) NOT NULL,
  `deviceid` varchar(256) NOT NULL,
  `devicetype` varchar(256) NULL,
  `id_child` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `access_token` (`access_token`,`deviceid`, `id_child`)
) ENGINE=InnoDB;

CREATE INDEX `idx_id_child2` ON `device_accesstoken_tbl` (`id_child` ASC) ;


-- -----------------------------------------------------
-- Table `question_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `question_tbl` ;

CREATE TABLE IF NOT EXISTS `question_tbl` ( 
`idq` INT NOT NULL AUTO_INCREMENT , 
`id_question` VARCHAR(100) NOT NULL , /* A unique varchar identifier as the question ID */
`id_game` VARCHAR(100) NOT NULL ,
`description` VARCHAR(512) NOT NULL , 
`id_question_type` INT NOT NULL , 
`id_micro_concept` INT NOT NULL , 
`id_level` INT NOT NULL,  /* 1 - beginner; 2 - intermediate ; 3 - expert */ 
`id_question_classification` INT NOT NULL , 
`correct_answer` VARCHAR(500) NULL, /* Not used. (23/1/18)*/
                                    /* 'correct answer' for the question. This field is not being used as the correct answer can not be predefined */
                                    /* (for example, the numbers are randomly generated by the game at the time of */
                                    /* rendering a multiplication question and hence the answer would depend on the numbers generated). */
                                    /* game will return 'Pass' status ('Yes/No') by comparing the correct answer expected and given answer inside the game */ 
PRIMARY KEY (`idq`) , 
CONSTRAINT `fk_qt_idgame` 
FOREIGN KEY (`id_game` ) 
REFERENCES `game_master_tbl` (`id_game` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION, 
CONSTRAINT `fk_qt_question_type` 
FOREIGN KEY (`id_question_type` ) 
REFERENCES `question_type_tbl` (`id_question_type` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION, 
CONSTRAINT `fk_qt_micro_concept` 
FOREIGN KEY (`id_micro_concept` ) 
REFERENCES `micro_concept_tbl` (`id_micro_concept` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION, 
CONSTRAINT `fk_qt_question_classification` 
FOREIGN KEY (`id_question_classification` ) 
REFERENCES `question_classification_tbl` (`id_question_classification` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION) 
ENGINE = InnoDB; 


-- -----------------------------------------------------
-- Table `ekstepevent_interact_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `ekstepevent_interact_tbl` ;

CREATE TABLE IF NOT EXISTS `ekstepevent_interact_tbl` (
  `eventdataid` int(11) NOT NULL AUTO_INCREMENT,
  `id_child` INT NOT NULL ,
  `id_game_play` VARCHAR(100) NOT NULL ,
  `id_question` VARCHAR(100) NOT NULL , 
  `ekstep_eventid` varchar(256) NOT NULL,
  `date_time_event` datetime NOT NULL,
  `event_type` varchar(256) NULL,
  `res_id` varchar(256) NULL,
  `synced` TINYINT not null default 0,
  PRIMARY KEY (`eventdataid`)
) ENGINE=InnoDB;



-- ----------------------------------------------------------
-- **********************************************************
-- Tables for ABB CHALLENGE MODE 
-- **********************************************************
-- ----------------------------------------------------------

-- ----------------------------------------------------------
-- Table: chm_walletscore_tbl
-- ----------------------------------------------------------

DROP TABLE IF EXISTS `chm_walletscore_tbl` ;

CREATE TABLE IF NOT EXISTS `chm_walletscore_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_child` INT NOT NULL ,
  `score` INT NOT NULL ,
  `datetime_lastupdated` datetime NOT NULL,
  `synced` TINYINT not null default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `chm_game_master_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `chm_game_master_tbl` ;

CREATE TABLE IF NOT EXISTS `chm_game_master_tbl` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_game` VARCHAR(100) NOT NULL ,    /* id_game to be a unique varchar instead of autoincrement integer as games can be from multiple vendors */
`game_description` VARCHAR(512) NOT NULL,
`id_grade` INT NOT NULL,
`gametoopen` VARCHAR(512) NULL, /* IDs of the Game(s) to be opened on completion of this Game (IDs seperated by comma) */
`prerequisitegame` VARCHAR(512) NULL, /* IDs of the Game(s) that should be completed before this Game can be played (IDs seperated by comma) */
PRIMARY KEY (`id`)) 
ENGINE = InnoDB;
CREATE INDEX `idx_game1` ON `chm_game_master_tbl` (`id_game` ASC) ;


-- -----------------------------------------------------
-- Table `chm_question_master_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `chm_question_master_tbl` ;

CREATE TABLE IF NOT EXISTS `chm_question_master_tbl` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_question` VARCHAR(100) NOT NULL , /* A unique varchar identifier as the question ID */
`id_game` VARCHAR(100) NOT NULL ,
`description` VARCHAR(512) NOT NULL , 
`id_question_type` INT NOT NULL , 
`id_micro_concept` INT NOT NULL,

PRIMARY KEY (`id`) , 
CONSTRAINT `fk_chmqt_idgame` 
FOREIGN KEY (`id_game` ) 
REFERENCES `chm_game_master_tbl` (`id_game` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION, 
CONSTRAINT `fk_chmqt_question_type` 
FOREIGN KEY (`id_question_type` ) 
REFERENCES `question_type_tbl` (`id_question_type` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION, 
CONSTRAINT `fk_chmqt_micro_concept` 
FOREIGN KEY (`id_micro_concept` ) 
REFERENCES `micro_concept_tbl` (`id_micro_concept` ) 
ON DELETE NO ACTION 
ON UPDATE NO ACTION) 
ENGINE = InnoDB; 

-- -----------------------------------------------------
-- Table `chm_game_play_tbl`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `chm_game_play_tbl` ;

CREATE TABLE IF NOT EXISTS `chm_game_play_tbl` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_game_play` VARCHAR(100) NOT NULL , 
`id_game` VARCHAR(100) NOT NULL,
`id_child` INT NOT NULL,
`start_time` datetime not null,
`hints` INT NOT NULL default 0,
`synced` TINYINT not null default 0,
PRIMARY KEY (`id`),
 CONSTRAINT `fk_chmchild_id` 
    FOREIGN KEY (`id_child` )
    REFERENCES `child_tbl` (`id_child` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;
CREATE INDEX `idx_game2` ON `chm_game_play_tbl` (`id_game` ASC) ;
CREATE INDEX `idx_game_play1` ON `chm_game_play_tbl` (`id_game_play` ASC) ;

-- -----------------------------------------------------
-- Table `chm_game_play_detail_tbl`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `chm_game_play_detail_tbl` ;

CREATE TABLE IF NOT EXISTS `chm_game_play_detail_tbl` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`id_game_play` VARCHAR(100) NOT NULL , 
`id_child` INT NOT NULL ,
`id_question` VARCHAR(100) NOT NULL , 
`date_time_submission` DATETIME NOT NULL,  /* When was the answer submitted to this question */
`time2answer` INT NOT NULL , /*time taken by the child to answer the question in seconds */ 
`pass` VARCHAR(25) NULL , /* Yes/No ('Yes' if 'given answer' and 'correct answer' are same. This comparison will be done within the game and the 'pass' status will be sent by the games ) */
`synced` TINYINT not null default 0,
PRIMARY KEY (`id`)) 
ENGINE = InnoDB;
CREATE INDEX `idx_chmgame_play2` ON `chm_game_play_detail_tbl` (`id_game_play` ASC) ;
CREATE INDEX `idx_chmid_child1` ON `chm_game_play_detail_tbl` (`id_child` ASC) ;
CREATE INDEX `idx_chmid_question1` ON `chm_game_play_detail_tbl` (`id_question` ASC) ;
