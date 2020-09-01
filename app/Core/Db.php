<?php

namespace App\Core;

use PDO;

class Db {
	public PDO $pdo;

	public function __construct() {
		$settings = $this->getPDOSettings();

		$this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
	}

	protected function getPDOSettings(): array {

		$config = include ROOT_PATH . "/config/db.php";

		$result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
		$result['user'] = $config['user'];
		$result['pass'] = $config['pass'];

		return $result;
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