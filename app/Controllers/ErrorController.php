<?php

namespace App\Controllers;

class ErrorController extends BaseController {
	public function actionError($params = []) {
		return $this->render('error.tpl', $params);
	}
}