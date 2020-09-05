<?php

namespace App\Core;

class Session {
	public string $flashParam = '__flash';

	public function __construct() {
		session_start();
	}

	public function get(string $key, $defaultValue = null) {
		return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue;
	}

	public function set(string $key, $value) {
		$_SESSION[$key] = $value;
	}

	public function remove($key) {
		if (isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
		}
	}

	public function addFlash(string $key, $value = true, $removeAfterAccess = true) {
		$counters = $this->get($this->flashParam, []);
		$counters[$key] = $removeAfterAccess ? -1 : 0;
		$_SESSION[$this->flashParam] = $counters;

		if (empty($_SESSION[$key])) {
			$_SESSION[$key] = [$value];
		} elseif (is_array($_SESSION[$key])) {
			$_SESSION[$key][] = $value;
		} else {
			$_SESSION[$key] = [$_SESSION[$key], $value];
		}
	}

	public function removeFlash(string $key) {
		$counters = $this->get($this->flashParam, []);
		$value = isset($_SESSION[$key], $counters[$key]) ? $_SESSION[$key] : null;
		unset($counters[$key], $_SESSION[$key]);
		$_SESSION[$this->flashParam] = $counters;
	}

	public function getFlash(string $key, $defaultValue = null, $delete = false) {
		$counters = $this->get($this->flashParam, []);
		if (isset($counters[$key])) {
			$value = $this->get($key, $defaultValue);
			if ($delete) {
				$this->removeFlash($key);
			} elseif ($counters[$key] < 0) {
				$counters[$key] = 1;
				$_SESSION[$this->flashParam] = $counters;
			}

			return $value;
		}

		return $defaultValue;
	}

	public function hasFlash(string $key): bool {
		return $this->getFlash($key) !== null;
	}

	public function getAllFlashes($delete = false) {
		$counters = $this->get($this->flashParam, []);
		$flashes = [];
		foreach (array_keys($counters) as $key) {
			if (array_key_exists($key, $_SESSION)) {
				$flashes[$key] = $_SESSION[$key];
				if ($delete) {
					unset($counters[$key], $_SESSION[$key]);
				} elseif ($counters[$key] < 0) {
					$counters[$key] = 1;
				}
			} else {
				unset($counters[$key]);
			}
		}

		$_SESSION[$this->flashParam] = $counters;

		return $flashes;
	}
}