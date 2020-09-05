<?php

namespace App;

use App\Models\Task;

class TaskViewModel {
	public int $total;
	public int $perPage;
	public int $page;
	/** @var string */
	public $sort;
	/** @var string */
	public $sortDirection;
	/** @var Task[] */
	public $models;

	public function getItems(): string {
		$result = [];

		foreach ($this->models as $model) {
			$result[] = $model->attributes();
		}

		return json_encode($result, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	}
}