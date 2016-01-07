DELIMITER $$

CREATE FUNCTION `fn_is_lobby_active`(
	db_id INT,
	ip_lobby_lock_minutes INT
) RETURNS tinyint
BEGIN
	DECLARE lobby_id BIGINT;
	DECLARE lobby_post_date INT;
	DECLARE lobby_closures INT;

	-- Store lobby information
	SELECT  `lobby_id`, `post_date`
	INTO lobby_id, lobby_post_date
	FROM `lobby_post`
	WHERE `id` = db_id;

	-- Invalid lobby check
	IF lobby_id IS NULL OR lobby_post_date IS NULL THEN
		RETURN 0;
	END IF;

	-- Select any rows that would close this lobby
	SET lobby_closures = (
		SELECT COUNT(`id`) FROM `closed_lobby`
		WHERE
			`lobby_id` = lobby_id
			AND lobby_post_date + ip_lobby_lock_minutes * 60 > `date`
		LIMIT 1);

	-- If a result return
	IF lobby_closures > 0 THEN
		RETURN 0;
	END IF;

	RETURN 1;
END $$

DELIMITER ;

