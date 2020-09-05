<?php

namespace App\Controllers;

use App\Core\App;
use App\Models\Task;

class TaskController extends BaseController {
	public function actionCreate() {
		$model = new Task();

		if (App::$request->isPost()) {
			$model->set_attributes($_POST['Task'] ?? []);

			if ($model->is_valid()) {
				$model->save();

				App::$session->addFlash('success', 'Задача успешно добавлена.');

				return $this->redirect(App::$router->homeUrl());
			}
		}

		return $this->render('task/create.tpl', [
			'model' => $model,
		]);
	}

	public function actionUpdate() {
		if (!App::$user->isAdmin) {
			App::$session->addFlash('warning', 'Авторизуйтесь как администратор для редактирования задачи.');

			return $this->redirect(App::$router->createUrl('user', 'login'));
		}

		/** @var Task $model */
		$model = Task::find('first', $_GET['id']);

		if (App::$request->isPost()) {
			$oldText = $model->text;

			$model->set_attributes($_POST['Task'] ?? []);

			if ($model->is_valid()) {
				if ($oldText != $model->text) {
					$model->is_updated_by_admin = 1;
				}

				$model->save();

				App::$session->addFlash('success', 'Задача успешно обновлена.');

				return $this->redirect(App::$router->homeUrl());
			}
		}

		return $this->render('task/update.tpl', [
			'model' => $model,
		]);
	}
}