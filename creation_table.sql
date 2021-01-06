CREATE SCHEMA BD_ANNONCES;

CREATE USER 'acces_annonce'@'localhost' IDENTIFIED WITH mysql_native_password BY '***';GRANT USAGE ON *.* TO 'acces_annonce'@'localhost';ALTER USER 'acces_annonce'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON `BD_ANNONCES`.* TO 'acces_annonce'@'localhost'; ALTER USER 'acces_annonce'@'localhost' ;

CREATE TABLE `BD_ANNONCES`.`T_typeMaison` ( 
	`T_type` VARCHAR(255) NOT NULL, 
	`T_description` VARCHAR(255) NOT NULL, 
	PRIMARY KEY (`T_type`)) ENGINE = InnoDB;

CREATE TABLE `BD_ANNONCES`.`T_Energie` ( 
	`E_id_engie` VARCHAR(255) NOT NULL , 
	`E_description` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`E_id_engie`)) ENGINE = InnoDB;
	
CREATE TABLE `BD_ANNONCES`.`T_utilisateur` ( 
	`U_mail` VARCHAR(255) NOT NULL , 
	`U_mdp` VARCHAR(255) NOT NULL , 
	`U_pseudo` VARCHAR(255) NOT NULL , 
	`U_nom` VARCHAR(255) NOT NULL , 
	`U_prenom` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`U_mail`)) ENGINE = InnoDB;
	
CREATE TABLE `BD_ANNONCES`.`T_annonce` ( 
	`A_idannonce` INT NOT NULL AUTO_INCREMENT,
	`A_titre` VARCHAR(255) NOT NULL , `A_cout_loyer` INT NOT NULL ,
	`A_cout_charges` INT NOT NULL , `A_type_chauffage` VARCHAR(255) NOT NULL ,
	`A_superficie` INT NOT NULL , `A_description` TEXT NOT NULL , 
	`A_ville` VARCHAR(255) NOT NULL , 
	`A_CP` INT NOT NULL ,
	`A_date` DATETIME NOT NULL , 
	`A_state` INT NOT NULL DEFAULT '1',	
	`U_mail` VARCHAR(255) NOT NULL , 
	`T_type` VARCHAR(255) NOT NULL , 
	`E_id_engie` VARCHAR(255) NOT NULL , 
	PRIMARY KEY (`A_idannonce`)) ENGINE = InnoDB;

ALTER TABLE `T_annonce` ADD CONSTRAINT `FK_energie` FOREIGN KEY (`E_id_engie`) REFERENCES `T_Energie`(`E_id_engie`); 
ALTER TABLE `T_annonce` ADD CONSTRAINT `FK_type` FOREIGN KEY (`T_type`) REFERENCES `T_typeMaison`(`T_type`); 
ALTER TABLE `T_annonce` ADD CONSTRAINT `FK_mail` FOREIGN KEY (`U_mail`) REFERENCES `T_utilisateur`(`U_mail`) ON DELETE CASCADE ON UPDATE CASCADE;	

CREATE TABLE `BD_ANNONCES`.`T_photo` ( 
	`P_idphoto` INT NOT NULL AUTO_INCREMENT, 
	`P_titre` VARCHAR(255) NOT NULL , 
	`P_nom` VARCHAR(255) NOT NULL , 
	`A_idannonce` INT NOT NULL ,
	PRIMARY KEY (`P_idphoto`)) ENGINE = InnoDB;

ALTER TABLE `T_photo` ADD CONSTRAINT `FK_ad` FOREIGN KEY (`A_idannonce`) REFERENCES `T_annonce`(`A_idannonce`);
 	
CREATE TABLE `bd_annonces`.`t_message` ( 
	`M_date` DATETIME NOT NULL , 
	`M_texte` TEXT NOT NULL , 
	`U_mail` VARCHAR(255) NOT NULL ,
	`U_receiver` VARCHAR(255) NOT NULL	,
	`A_idannonce` INT NOT NULL ) ENGINE = InnoDB;
	
ALTER TABLE `T_message` ADD CONSTRAINT `FK_uti` FOREIGN KEY (`U_mail`) REFERENCES `T_utilisateur`(`U_mail`); 
ALTER TABLE `T_message` ADD CONSTRAINT `FK_receiver` FOREIGN KEY (`U_receiver`) REFERENCES `T_utilisateur`(`U_mail`); 
ALTER TABLE `T_message` ADD CONSTRAINT `FK_annonce` FOREIGN KEY (`A_idannonce`) REFERENCES `T_annonce`(`A_idannonce`);

INSERT INTO `t_energie` (`E_id_engie`, `E_description`) VALUES ('1', 'test');
INSERT INTO `t_typemaison` (`T_type`, `T_description`) VALUES ('appart', 'test');
