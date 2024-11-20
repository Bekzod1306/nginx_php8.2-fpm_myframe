<?php
//https://cloud.mail.ru/public/ox3N/zCFxc6iEm

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

use Bek\Framework\Http\Kernel;
use Bek\Framework\Http\Request;

$request =  Request::createFromGlobals();
$content = "<h1>TESt</h1>";
// dd(BASE_PATH);
$container = require BASE_PATH . '/config/services.php';
$kernel = $container->get(Kernel::class);
// dd($kernel);
$response = $kernel->handle($request);

$response->send();

// dd($request);
