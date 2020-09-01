<?php

namespace App\Core;

use App\Exceptions\InvalidRouteException;
use App\Exceptions\NotFoundException;

class App {
	public static Router $router;

	public static Db $db;

	public static Kernel $kernel;

	public static function init() {
		static::bootstrap();

		set_exception_handler([App::class, 'handleException']);
	}

	public static function run() {
		static::$kernel->run();
	}

	public static function bootstrap() {
		static::$router = new Router();
		static::$db = new Db();
		static::$kernel = new Kernel();
	}

	public static function handleException(\Throwable $e) {
		if ($e instanceof InvalidRouteException || $e instanceof NotFoundException) {
			http_response_code(404);
			echo static::$kernel->launchAction('Error', 'error', ['exception' => $e]);
		} else {
			throw $e;
		}
	}
}