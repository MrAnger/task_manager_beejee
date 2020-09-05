<?php

namespace App\Models;

use ActiveRecord\Model;

/**
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $text
 * @property integer $is_completed
 * @property integer $is_updated_by_admin
 */
class Task extends Model {
	public static $table_name = 'tasks';

	static $validates_length_of = [
		['username', 'within' => [1, 100]],
		['email', 'within' => [1, 100]],
		['text', 'within' => [1, 100]],
	];
}