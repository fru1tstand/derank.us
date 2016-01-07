-- -- ! Data display tables
-- Stores all lobby posts (even repeated lobby posts).
CREATE TABLE `lobby_post` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`lobby_id` BIGINT NOT NULL,
	`display_name` VARCHAR(64) NOT NULL,
	`post_date` INT NOT NULL,
	`profile_id` BIGINT DEFAULT NULL,
	`title` TEXT DEFAULT NULL,

	INDEX `ix_lobby_id` (`lobby_id`)
) DEFAULT CHARSET = utf8;

-- Populated whenever a lobby owner "closes" the lobby.
CREATE TABLE `closed_lobby` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`lobby_id` BIGINT NOT NULL,
	`date` INT NOT NULL,

	INDEX `ix_lobby_id` (`lobby_id`)
) DEFAULT CHARSET = utf8;



-- -- ! Analytic tables
-- Holds all user agent headers used in analytics
CREATE TABLE `user_agent` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`md5` CHAR(32) UNIQUE,
	`ua` TEXT NOT NULL,

	INDEX `ix_md5` (`md5`)
) DEFAULT CHARSET = utf8;

-- All-encompassing analytics table. Should be written to every page load, AJAX request, etc.
CREATE TABLE `analytic` (
	`id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`user_agent_id` INT NOT NULL,
	`time` INT NOT NULL,
	`ip` VARCHAR(45) NOT NULL,
	`url` VARCHAR(2096) NOT NULL,

	CONSTRAINT `fk_analytic_user_agent`
		FOREIGN KEY (`user_agent_id`) REFERENCES `user_agent` (`id`)
) DEFAULT CHARSET = utf8;

-- Subtype of the analytic table. Written to whenever a hide request is called.
CREATE TABLE `analytic_hide` (
	`analytic_id` INT NOT NULL,
	`lobby_id` BIGINT NOT NULL,

	PRIMARY KEY (`analytic_id`, `lobby_id`),
	CONSTRAINT `fk_analytic_hide_analytic`
		FOREIGN KEY (`analytic_id`) REFERENCES `analytic` (`id`)
) DEFAULT CHARSET = utf8;

-- Subtype of the analytic table. Written to whenever a getlink request.
CREATE TABLE `analytic_getlink` (
	`raw_analytic_id` INT NOT NULL,
	`lobby_post_id` INT NOT NULL,

	PRIMARY KEY (`raw_analytic_id`, `lobby_post_id`),
	CONSTRAINT `fk_analytic_getlink_analytic`
		FOREIGN KEY (`raw_analytic_id`) REFERENCES `analytic` (`id`),
	CONSTRAINT `fk_analytic_getlink_lobby_post`
		FOREIGN KEY (`lobby_post_id`) REFERENCES `lobby_post` (`id`)
) DEFAULT CHARSET = utf8;


-- -- ! API/Scrape tables
-- Lookup table for raw dump types.
CREATE TABLE `raw_dump_type` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`name` VARCHAR(64) NOT NULL UNIQUE,
	`descr` VARCHAR(256) NULL
) DEFAULT CHARSET = utf8;

-- Holds all ajax calls to any api or service
CREATE TABLE `raw_dump` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`raw_dump_type_id` INT NOT NULL,
	`time_fetched` INT NOT NULL,
	`value` MEDIUMTEXT NULL,

	CONSTRAINT `fk_raw_dump_raw_dump_type`
		FOREIGN KEY (`raw_dump_type_id`) REFERENCES `raw_dump_type` (`id`)
) DEFAULT CHARSET = utf8;



-- -- ! Sanitation tables
-- Controls lobby posting through client
CREATE TABLE `validation_lobby_submit` (
	`id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`lobby_id` BIGINT NOT NULL,
	`ip` VARCHAR(65) NOT NULL,
	`post_date` INT NOT NULL
) DEFAULT CHARSET = utf8;

-- Controls lobby posting from steam community comments
CREATE TABLE `validation_steam_comments` (
	`id` BIGINT PRIMARY KEY NOT NULL
) DEFAULT CHARSET = utf8
