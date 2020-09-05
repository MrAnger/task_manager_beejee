<?php

namespace App\Core;

use App\Exceptions\InvalidRouteException;
use App\Exceptions\NotFoundException;
use App\User;

class App {
	public static Router $router;

	public static Db $db;

	public static Kernel $kernel;

	public static Request $request;

	public static Session $session;

	public static User $user;

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
		static::$request = new Request();
		static::$session = new Session();
		static::$user = new User();
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