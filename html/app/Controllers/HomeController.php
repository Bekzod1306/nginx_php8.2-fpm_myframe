<?php

namespace App\Controllers;

use Bek\Framework\Http\Response;

class HomeController {
    public function index():Response{
        $content = "<h1>TEST controller</h1>";

        return new Response($content);
    }
}