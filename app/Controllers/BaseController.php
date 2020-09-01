<?php

namespace App\Controllers;

abstract class BaseController {
	public string $layout = 'main';

	/**
	 * @param string $body
	 *
	 * @return string
	 *
	 * @throws
	 */
	public function renderLayout($body = null) {
		$path = LAYOUT_PATH . DIRECTORY_SEPARATOR . $this->layout . ".php";

		if (!file_exists($path)) {
			throw new \Exception("Layout file $path not found.");
		}

		ob_start();

		require $path;

		return ob_get_clean();
	}

	/**
	 * @param string $viewName
	 * @param array $params
	 *
	 * @return string
	 * @throws
	 */
	public function render(string $viewName, array $params = []) {
		$path = VIEW_PATH . DIRECTORY_SEPARATOR . $viewName . ".php";

		if (!file_exists($path)) {
			throw new \Exception("View file $path not found.");
		}

		extract($params);

		ob_start();
		require $path;

		$body = ob_get_clean();
		ob_end_clean();

		if ($this->layout === false) {
			return $body;
		}

		return $this->renderLayout($body);
	}
}