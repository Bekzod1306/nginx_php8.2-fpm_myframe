<?php

use App\Controllers\HomeController;
use App\Controllers\PostController;
use Bek\Framework\Http\Response;
use Bek\Framework\Routing\Route;

return [
    Route::get('/',[HomeController::class,'index']),
    Route::get('/posts/create',[PostController ::class,'create']),
    Route::get('/posts/{id}',[PostController ::class,'show']),
    Route::post('/posts/store',[PostController ::class,'store']),
    Route::get('/hi/{name}',function(string $name){
        return new Response("Hello $name");
    })
];