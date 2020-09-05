<?php

namespace App\Controllers;

use App\Core\App;
use Smarty;

abstract class BaseController {
	protected Smarty $smarty;

	public function __construct() {
		$this->initSmarty();
	}

	public function redirect(string $url, int $code = 302) {
		header("Location: $url", true, $code);

		return true;
	}

	/**
	 * @param string $viewName
	 * @param array $params
	 *
	 * @return string
	 * @throws
	 */
	public function render(string $viewName, array $params = []) {
		$this->smarty->assign('app', App::class);
		$this->smarty->assign('router', App::$router);
		$this->smarty->assign('session', App::$session);
		$this->smarty->assign('user', App::$user);

		$this->smarty->assign($params);

		$this->smarty->display($viewName);
	}

	protected function initSmarty() {
		$this->smarty = new Smarty();

		$this->smarty->setTemplateDir(VIEW_PATH);
		$this->smarty->setCompileDir(realpath(STORAGE_PATH . "/smarty/templates_compiled"));
		$this->smarty->setConfigDir(realpath(CONFIG_PATH . "/smarty"));
		$this->smarty->setCacheDir(realpath(STORAGE_PATH . "/smarty/cache"));
	}
}