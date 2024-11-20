<?php

namespace App\Controllers;

use App\Services\YouTubeService;
use Bek\Framework\Http\Response;

class HomeController {
    public function __construct(
        private readonly YouTubeService $youtube
    ) {
        
    }
    public function index():Response{
        $content = "<h1>TEST controller</h1>";
        $content .= "<a href=\"{$this->youtube->getChannelUrl()}\">Youtube</a>";
        return new Response($content);
    }
}