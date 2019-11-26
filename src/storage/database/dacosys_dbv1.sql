/**
 * +----------------------------------------------------------------+
 * |                             DACOSYS                            |
 * +----------------------------------------------------------------+
 *
 * DEVELOPED BY:
 * Lucas Fonseca dos Santos - github.com/LucasFonsecaDosSantos
 * Marco Aurelio Ferreira de Sousa - github.com/maureliofs
 * Lucas Fiorini Braga - github.com/ ...
 *
 * License: GNU/GPL - General Public License - V3
 *
 * Latest Update: 08/15/2019
 *
 * The Dacosys database modeling structure.
 * <a brief>
 */
CREATE SCHEMA IF NOT EXISTS `dacosys` DEFAULT CHARACTER SET utf8 ;
USE `dacosys` ;





/**
 * +----------------------------------------------------------------+
 * | CREATING ALL DATABASE TABLES                                   +
 * +----------------------------------------------------------------+
 *
 * - aPerson
 * - Person Telephone
 * - Person Disease
 * - Quiz
 * - Researcher ACCESS Quiz
 * - Item
 * - item_picture
 * - Item HAS Picture
 * - Participant ANSWER Quiz
 * - Participant ANSWER Item
 */
CREATE TABLE IF NOT EXISTS `dacosys`.`person` (
    `id_person`                 CHAR(20)    NOT NULL,
    `type`                      ENUM('_ADMINISTRATOR_','_RESEARCHER_','_PARTICIPANT_') NOT NULL,
    `name`                      VARCHAR(40),
    `email`                     VARCHAR(40),
    `password`                  CHAR(60),
    `participated`              TINYINT,
    `sex`                       ENUM('_M_','_F_','_O_'),
    `hometown_cep`              CHAR(8),
    `color`                     ENUM('_BRANCA_','_PARDA_','_PRETA_', '_AMARELA_', '_INDIGENA_'),
    `birth_day`                 DATE,
    `latest_access`             DATE,
    `latest_ip_access`          VARCHAR(15),
    `is_administrator`          TINYINT NOT NULL,
    `supervisor_idPerson`       CHAR(20),
    PRIMARY KEY(`id_person`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`telephone` (
    `person_idPerson`   CHAR(20)      NOT NULL,
    `telephone`         VARCHAR(13) NOT NULL,
    PRIMARY KEY(`person_idPerson`, `telephone`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`special_needs` (
    `participant_idPerson`  CHAR(20)  NOT NULL,
    `need`                  VARCHAR(200)    NOT NULL,
    PRIMARY KEY(`participant_idPerson`, `need`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`quiz` (
    `id_quiz`           CHAR(18)  NOT NULL,
    `name`              TEXT    NOT NULL,
    `start_date`        DATE    NOT NULL,
    `end_date`          DATE    NOT NULL,
    `status`            TINYINT NOT NULL,
    PRIMARY KEY(`id_quiz`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`reseacher_access_quiz` (
    `reseacher_idPerson`    CHAR(20)  NOT NULL,
    `quiz_idQuiz`           CHAR(18)  NOT NULL,
    PRIMARY KEY(`reseacher_idPerson`,`quiz_idQuiz`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`item` (
    `id_item`           CHAR(18) NOT NULL,
    `enunciation`       VARCHAR(150),
    `quiz_idQuiz`       CHAR(18) NOT NULL,
    `answer_type`       ENUM('_DISCREET_','_CONTINUOUS_') NOT NULL,
    `answer_discret_amount` INT(2),
    PRIMARY KEY(`id_item`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`item_picture` (
    `id_item_picture`    CHAR(26)      NOT NULL,
    `title`         VARCHAR(50),
    `path`          CHAR(30)    NOT NULL,
    PRIMARY KEY(`id_item_picture`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`item_has_picture` (
    `item_picture_idPicture`    CHAR(26)  NOT NULL,
    `item_idItem`               CHAR(18)  NOT NULL,
    PRIMARY KEY(`item_picture_idPicture`,`item_idItem`)
)ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `dacosys`.`participant_answer_item` (
    `participant_idPerson`  CHAR(20)      NOT NULL,
    `item_idItem`           CHAR(18)      NOT NULL,
    `description`           VARCHAR(80),
    `answer`                FLOAT       NOT NULL,
    `data_hour`             DATETIME    NOT NULL,
    PRIMARY KEY(`participant_idPerson`,`item_idItem`)
)ENGINE = InnoDB;




/**
 * +----------------------------------------------------------------+
 * | CREATING THE UNIQUE KEYS                                       +
 * +----------------------------------------------------------------+
 */
CREATE UNIQUE INDEX `uk_person_email` ON `dacosys`.`person` (`email` ASC);




/**
 * +----------------------------------------------------------------+
 * | CREATING ALL TABLE CONSTRAINTS                                 +
 * +----------------------------------------------------------------+
 */
 ALTER TABLE `person`
    ADD CONSTRAINT fk_person_supervisor
    FOREIGN KEY (`supervisor_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `telephone`
    ADD CONSTRAINT fk_person_person
    FOREIGN KEY (`person_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `special_needs`
    ADD CONSTRAINT fk_person_participant
    FOREIGN KEY (`participant_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `reseacher_access_quiz`
    ADD CONSTRAINT fk_person_researcher
    FOREIGN KEY (`reseacher_idPerson`)
    REFERENCES `person` (`id_person`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `item_has_picture`
    ADD CONSTRAINT fk_item_item
    FOREIGN KEY (`item_idItem`)
    REFERENCES `item` (`id_item`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `item_has_picture`
    ADD CONSTRAINT fk_picture_picture
    FOREIGN KEY (`item_picture_idPicture`)
    REFERENCES `item_picture` (`id_item_picture`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE `item`
    ADD CONSTRAINT fk_quiz_idQuiz
    FOREIGN KEY (`quiz_idQuiz`)
    REFERENCES `quiz` (`id_quiz`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;