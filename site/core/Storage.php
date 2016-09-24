<?php

require_once APPLICATION_ROOT . '/core/Application.php';

/**
 * Class Storage
 */
class Storage
{
	protected $_pdo;

	/**
	 *
	 */
	public function __construct()
	{
		$config = Application::getConfig();

		$this->_pdo = new PDO($config['db']['dsn'], $config['db']['username'], $config['db']['password'], [
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		]);
	}
}