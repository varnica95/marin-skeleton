<?php

use Core\App;
use Core\Http\Request;

require_once __DIR__.'/../vendor/autoload.php';

$app = new App();

$request = new Request();
$app->handle($request);