<?php

namespace App\Core;

class Router {
	public string $controllerKey = 'controller';

	public string $actionKey = 'action';

	public array $homeRoute = ['home', 'index'];

	public function resolve(): array {
		$controller = $_GET[$this->controllerKey] ?? $this->homeRoute[0];
		$action = $_GET[$this->actionKey] ?? $this->homeRoute[1];

		// Получим массив get параметров и уберем от туда лишнее
		$params = $_GET;
		unset($params[$this->controllerKey]);
		unset($params[$this->actionKey]);

		return [
			$controller,
			$action,
			$params,
		];
	}
}