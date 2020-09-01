<?php

use App\Core\App;

define('ROOT_PATH', realpath(__DIR__ . '/..'));
define('CONTROLLER_PATH', realpath(ROOT_PATH . '/app/Controllers'));
define('VIEW_PATH', realpath(ROOT_PATH . '/resources/views'));
define('LAYOUT_PATH', realpath(VIEW_PATH . '/layouts'));

require __DIR__ . '/../vendor/autoload.php';

App::init();

App::run();
