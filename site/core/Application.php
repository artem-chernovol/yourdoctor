<?php

/**
 * Class Application
 */
class Application
{
	static public $route;

	/**
	 *
	 */
	static public function processRoute()
	{
		$part = explode('?', $_SERVER['REQUEST_URI']);
		self::$route = $part[0];
	}

	/**
	 *
	 */
	static public function runController()
	{
		switch (self::$route) {
			case('/'):
				require_once APPLICATION_ROOT . '/application/controller/index.php';
				break;
			case('/services'):
				require_once APPLICATION_ROOT . '/application/controller/services.php';
				break;
			case('/contacts'):
				require_once APPLICATION_ROOT . '/application/controller/contacts.php';
				break;
			default:
				require_once APPLICATION_ROOT . '/application/controller/page-was-not-found.php';
				break;
		}
	}

	/**
	 * @return string
	 */
	static public function getConfig()
	{
		return require_once APPLICATION_ROOT . '/config/env/' . ENVIERONMENT . '.php';
	}
}