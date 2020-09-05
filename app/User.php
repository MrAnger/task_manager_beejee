<?php

namespace App;

use App\Core\App;
use IlluminateAgnostic\Arr\Support\Arr;

class User {
	public $username;
	public bool $isAdmin = false;

	public function __construct() {
		$username = App::$session->get('user', null);

		if ($username) {
			$users = static::getUserList();

			$user = Arr::get($users, $username, []);

			$this->username = Arr::get($user, 'username');
			$this->isAdmin = Arr::get($user, 'is_admin', false);
		}
	}

	public function isAuth(): bool {
		return $this->username !== null;
	}

	public static function getUserList(): array {
		$path = ROOT_PATH . "/config/users.php";

		$users = include $path;

		return $users;
	}
}