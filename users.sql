CREATE TABLE `ci_polls`.`users` ( `id` INT NOT NULL AUTO_INCREMENT ,
 `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL ,
 `password` VARCHAR(255) NOT NULL ,
`registered_data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `users` ADD `is_admin` INT NOT NULL DEFAULT '0' AFTER `username`;

CREATE TABLE `ci_polls`.`user_votes` ( `id` INT NOT NULL AUTO_INCREMENT ,
 `user_id` INT NOT NULL , `question_id` INT NULL ,
 `voted_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;

 ALTER TABLE `user_votes` CHANGE `question_id` `question_id` INT(11) NOT NULL;

ALTER TABLE `user_votes` ADD `is_admin` INT NOT NULL DEFAULT '0' AFTER `user_id`;
