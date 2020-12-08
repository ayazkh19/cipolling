CREATE TABLE `ci_polls`.`choices` 
( `id` INT NOT NULL AUTO_INCREMENT ,
 `choice_text` VARCHAR(255) NOT NULL ,
 `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `question_id` INT NULL DEFAULT NULL ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;
 
 ALTER TABLE `choices` ADD `votes` INT NOT NULL DEFAULT '0' AFTER `choice_text`;