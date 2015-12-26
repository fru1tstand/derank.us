<?php
namespace csgoderank\database;
use common\mysql\MySQL;
use common\mysql\QueryBuilder;

require_once $_SERVER['DOCUMENT_ROOT'] . '/.site/php/csgoderank/Setup.php';

class Analytics {
	/**
	 * @throws \Exception
	 */
	public static function insertPageloadAnalytic() {
		MySQL::newQueryBuilder()
				// user_agent, access_time, ip, url
			->withQuery("CALL sp_add_analytic(?, ?, ?, ?)")
			->withParam($_SERVER['HTTP_USER_AGENT'], QueryBuilder::PARAM_TYPE_STRING)
			->withParam(time(), QueryBuilder::PARAM_TYPE_INT)
			->withParam($_SERVER['REMOTE_ADDR'], QueryBuilder::PARAM_TYPE_STRING)
			->withParam($_SERVER['REQUEST_URI'], QueryBuilder::PARAM_TYPE_STRING)
			->build();
	}

	/**
	 * @param int $lobbyId
	 * @throws \Exception
	 */
	public static function insertGetlinkAnalytic(int $lobbyId) {
		MySQL::newQueryBuilder()
				// user_agent, access_time, ip, url, lobbyId
				->withQuery("CALL sp_add_analytic_getlink(?, ?, ?, ?, ?)")
				->withParam($_SERVER['HTTP_USER_AGENT'], QueryBuilder::PARAM_TYPE_STRING)
				->withParam(time(), QueryBuilder::PARAM_TYPE_INT)
				->withParam($_SERVER['REMOTE_ADDR'], QueryBuilder::PARAM_TYPE_STRING)
				->withParam("/getlink", QueryBuilder::PARAM_TYPE_STRING)
				->withParam($lobbyId, QueryBuilder::PARAM_TYPE_INT)
				->build();
	}
}
