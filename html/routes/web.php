<?php

use App\Controllers\HomeController;
use Bek\Framework\Http\Response;
use Bek\Framework\Routing\Route;

return [
    Route::get('/',[HomeController::class,'index']),
    Route::get('/hi/{name}',function(string $name){
        return new Response("Hello $name");
    })
];