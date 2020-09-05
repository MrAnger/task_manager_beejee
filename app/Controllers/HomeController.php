<?php

namespace App\Controllers;

use App\Models\Task;
use App\TaskViewModel;
use IlluminateAgnostic\Arr\Support\Arr;

class HomeController extends BaseController {
	public function actionIndex() {
		// Получим данные пагинации
		$page = $this->getPage();
		$perPage = 3;
		$offset = ($page - 1) * $perPage;

		// Получим данные сортировки
		[$sort, $sortDirection] = $this->getSort();

		// Подготовим условия выборки
		$queryConditions = [
			'limit' => $perPage,
			'offset' => $offset,
		];

		if ($sort !== null) {
			$queryConditions['order'] = "$sort $sortDirection";
		}

		// Подготовим ViewModel целевой страницы и наполним её необходимыми данными
		$viewModel = new TaskViewModel();

		$viewModel->page = $page;
		$viewModel->perPage = $perPage;
		$viewModel->total = Task::count();
		$viewModel->sort = $sort;
		$viewModel->sortDirection = $sortDirection;
		$viewModel->models = Task::find('all', $queryConditions);

		// Рендер страницы
		return $this->render('task\index.tpl', [
			'viewModel' => $viewModel,
		]);
	}

	protected function getSort(): array {
		$sort = Arr::get($_GET, 'sort');
		$sortDirection = Arr::get($_GET, 'sort-direction', 'asc');

		if (!in_array($sort, ['username', 'email', 'is_completed'])) {
			$sort = null;
		}

		if (!in_array($sortDirection, ['asc', 'desc'])) {
			$sortDirection = null;
		}

		return [
			$sort,
			$sortDirection,
		];
	}

	protected function getPage(): int {
		$page = Arr::get($_GET, 'page', 1);

		if (!is_numeric($page)) {
			return 1;
		}

		return $page;
	}
}