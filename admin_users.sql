CREATE TABLE `ci_polls`.`admin_users` ( `id` INT NOT NULL AUTO_INCREMENT ,
    `username` VARCHAR(255) NOT NULL ,
     `is_admin` INT NOT NULL DEFAULT '0' ,
      `email` VARCHAR(255) NOT NULL ,
       `password` VARCHAR(255) NOT NULL ,
        `registered_data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
         PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `admin_users`
  (`id`, `username`, `is_admin`, `email`, `password`, `registered_data`) VALUES (NULL, 'admin', '1', 'admin@aol.com', 'admin', current_timestamp())

UPDATE `admin_users` SET `password` = '21232f297a57a5a743894a0e4a801fc3' WHERE `admin_users`.`id` = 1;
