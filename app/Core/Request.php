<?php

namespace App\Core;

class Request {
	public function isPost(): bool {
		return strtolower($_SERVER['REQUEST_METHOD']) == 'post';
	}
}