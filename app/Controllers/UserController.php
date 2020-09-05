<?php

namespace App\Controllers;

use App\Core\App;
use App\LoginViewModel;
use App\User;
use IlluminateAgnostic\Arr\Support\Arr;

class UserController extends BaseController {
	public function actionLogin() {
		$model = new LoginViewModel();

		if (App::$request->isPost()) {
			$model->login = trim(Arr::get($_POST, 'login'));
			$model->password = Arr::get($_POST, 'password');

			$users = User::getUserList();
			$user = Arr::get($users, $model->login, []);

			if (Arr::get($user, 'username') == $model->login && Arr::get($user, 'password') == $model->password) {
				App::$session->set('user', $model->login);

				App::$session->addFlash('success', 'Вы успешно авторизовались на сайте.');

				return $this->redirect(App::$router->homeUrl());
			} else {
				$model->error = "Неверный логин или пароль.";
			}
		}

		return $this->render('user/login.tpl', [
			'model' => $model,
		]);
	}

	public function actionLogout() {
		App::$session->remove('user');

		App::$session->addFlash('success', 'Вы успешно вышли с сайта.');

		return $this->redirect(App::$router->homeUrl());
	}
}