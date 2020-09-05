<?php

namespace App\Core;

use ActiveRecord\Config;
use PDO;

class Db {
	public PDO $pdo;

	protected array $databaseConfig;

	public function __construct() {
		$this->loadDatabaseConfig();

		$settings = $this->getPDOSettings();

		$this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], null);

		$this->initActiveRecord();
	}

	protected function initActiveRecord() {
		$config = $this->databaseConfig;

		Config::initialize(function (Config $cfg) use ($config) {
			$cfg->set_model_directory(MODEL_PATH);
			$cfg->set_connections(
				[
					'development' => "{$config['type']}://{$config['user']}:{$config['pass']}@{$config['host']}/{$config['dbname']}",
				]
			);
			$cfg->set_default_connection('development');
		});
	}

	protected function getPDOSettings(): array {
		$config = $this->databaseConfig;

		$result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
		$result['user'] = $config['user'];
		$result['pass'] = $config['pass'];

		return $result;
	}

	protected function loadDatabaseConfig() {
		$path = ROOT_PATH . "/config/db.php";

		if (!file_exists($path)) {
			throw new \Exception("Database config file $path not found.");
		}

		$this->databaseConfig = include $path;
	}


	public function execute(string $query, array $params = []): array {
		if (empty($params)) {
			$stmt = $this->pdo->query($query);

			return $stmt->fetchAll();
		}

		$stmt = $this->pdo->prepare($query);
		$stmt->execute($params);

		return $stmt->fetchAll();
	}

	/**
	 * @param string $query
	 *
	 * @return false|int
	 */
	public function exec(string $query) {
		return $this->pdo->exec($query);
	}
}