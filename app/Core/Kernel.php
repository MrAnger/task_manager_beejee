<?php

namespace App\Core;

use App\Exceptions\InvalidRouteException;

class Kernel {
	public function run() {
		[$controllerName, $actionName, $params] = App::$router->resolve();

		echo $this->launchAction($controllerName, $actionName, $params);
	}


	public function launchAction(string $controllerName, string $actionName, $params = []) {
		$path = CONTROLLER_PATH . DIRECTORY_SEPARATOR . ucfirst($controllerName) . "Controller.php";

		if (!file_exists($path)) {
			throw new InvalidRouteException("Controller file $path not found.");
		}

		require_once $path;

		$className = "\\App\\Controllers\\" . ucfirst($controllerName) . "Controller";
		if (!class_exists($className)) {
			throw new InvalidRouteException("Class $className not found.");
		}

		$controller = new $className;
		$actionName = 'action' . ucfirst($actionName);
		if (!method_exists($controller, $actionName)) {
			throw new InvalidRouteException("Method $actionName in $className not found.");
		}

		return $controller->$actionName($params);
	}
}