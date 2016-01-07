DELIMITER $$

-- -- ! Analytic procedures
-- Add a basic analytic (page load)
CREATE PROCEDURE `sp_add_analytic` (
	IN user_agent TEXT,
	IN access_time INT,
	IN ip VARCHAR(45),
	IN url VARCHAR(2096)
)
BEGIN
	DECLARE user_agent_hash CHAR(32);
	DECLARE user_agent_id INT;

	-- Get UA id or make one
	SET user_agent_hash = MD5(user_agent);
	SET user_agent_id = (SELECT `id` FROM `user_agent` WHERE `md5` = user_agent_hash);
	IF user_agent_id IS NULL THEN
		INSERT INTO `user_agent` (`md5`, `ua`)
			VALUES (user_agent_hash, user_agent);
		SET user_agent_id = LAST_INSERT_ID();
	END IF;

	INSERT INTO `analytic` (`user_agent_id`, `time`, `ip`, `url`)
		VALUES (user_agent_id, access_time, ip, url);
END $$

-- Add a /getlink analytic
CREATE PROCEDURE `sp_add_analytic_getlink` (
	IN user_agent TEXT,
	IN access_time INT,
	IN ip VARCHAR(45),
	IN url VARCHAR(2096),
	IN db_id INT
)
BEGIN
	DECLARE raw_analytic_id INT;

	CALL sp_add_analytic(user_agent, access_time, ip, url);
	SET raw_analytic_id = LAST_INSERT_ID();

	INSERT INTO `analytic_getlink` (`raw_analytic_id`, `lobby_post_id`)
		VALUES (raw_analytic_id, db_id);
END $$

-- Add a /hide analytic
CREATE PROCEDURE `sp_add_analytic_hide` (
	IN user_agent TEXT,
	IN access_time INT,
	IN ip VARCHAR(45),
	IN url VARCHAR(2096),
	IN lobby_id BIGINT
)
BEGIN
	DECLARE raw_analytic_id INT;

	CALL sp_add_analytic(user_agent, access_time, ip, url);
	SET raw_analytic_id = LAST_INSERT_ID();

	INSERT INTO `analytic_hide` (`raw_analytic_id`, `lobby_id`)
		VALUES (raw_analytic_id, lobby_id);
END $$



-- -- ! API/Scrape procedures
-- Basic fetch dump insert
CREATE PROCEDURE `sp_add_dump` (
	IN raw_dump_type_name VARCHAR(64),
	IN time_fetched INT,
	IN dump_value MEDIUMTEXT
)
BEGIN
	DECLARE raw_dump_type_id INT;
	SET raw_dump_type_id = (SELECT `id` FROM `raw_dump_type` WHERE `name` = raw_dump_type_name);
	IF raw_dump_type_id IS NULL THEN
		INSERT INTO `raw_dump_type` (`name`) VALUES (raw_dump_type_name);
		SET raw_dump_type_id = LAST_INSERT_ID();
	END IF;

	INSERT INTO `raw_dump` (`raw_dump_type_id`, `time_fetched`, `value`)
		VALUES (raw_dump_type_id, time_fetched, dump_value);
END $$



-- -- ! Lobby posting
-- Lobby from steam community comment
CREATE PROCEDURE `sp_add_lobby_post_from_steam`(
	IN comment_id BIGINT,
	IN lobby_id BIGINT,
	IN display_name VARCHAR(64),
	IN post_date INT,
	IN profile_id BIGINT,
	IN comment_text TEXT
)
BEGIN
	-- Check if comment already exists in database
	IF NOT EXISTS (SELECT * FROM `validation_steam_comments` WHERE `id` = comment_id) THEN
		INSERT INTO `validation_steam_comments` (`id`) VALUES (comment_id);
		INSERT INTO `lobby_post` (`lobby_id`, `display_name`, `post_date`, `profile_id`, `title`)
			VALUES (lobby_id, display_name, post_date, profile_id, comment_text);
	END IF;
END $$

-- Lobby from website post
CREATE PROCEDURE `sp_add_lobby_post_from_website`(
	IN lobby_id BIGINT,
	IN display_name VARCHAR(64),
	IN post_date INT,
	IN profile_id BIGINT,
	IN title TEXT,
	IN ip VARCHAR(65),
	IN lobby_ip_minutes INT,
	OUT return_status TEXT
)
PROC:BEGIN
	SET return_status = '';

	-- A single IP should only ever control a single lobby id
	DELETE FROM `validation_lobby_submit` WHERE `ip` = ip;

	-- If someone else controls this lobby id, give error
	IF EXISTS (
			SELECT `id` FROM `validation_lobby_submit`
			WHERE `lobby_id` = lobby_id
					AND `ip` <> ip
					AND (`post_date` + (lobby_ip_minutes * 60)) > post_date) THEN
		SET return_status = 'Someone has already posted this lobby! Try starting a new lobby if you believe this error is a mistake.';
		LEAVE PROC;
	END IF;

	INSERT INTO `validation_lobby_submit` (`lobby_id`, `ip`, `post_date`)
		VALUES (lobby_id, ip, post_date);
	INSERT INTO `lobby_post` (`lobby_id`, `display_name`, `post_date`, `profile_id`, `title`)
		VALUES (lobby_id, display_name, post_date, profile_id, title);
END $$

DELIMITER ;
