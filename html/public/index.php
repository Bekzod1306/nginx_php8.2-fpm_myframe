<?php
//https://cloud.mail.ru/public/ox3N/zCFxc6iEm

define('BASE_PATH',dirname(__DIR__));

require_once BASE_PATH.'/vendor/autoload.php';

use Bek\Framework\Http\Kernel;
use Bek\Framework\Http\Request;
use Bek\Framework\Http\Response;
use Bek\Framework\Routing\Router;

$request =  Request::createFromGlobals();
$content = "<h1>TESt</h1>";
// dd(BASE_PATH);
$router = new Router();
$kernel = new Kernel($router);
$response = $kernel->handle($request);

$response->send();

dd($request);