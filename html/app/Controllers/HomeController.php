<?php

namespace App\Controllers;

use App\Services\YouTubeService;
use Bek\Framework\Controller\AbstractContoller;
use Bek\Framework\Http\Response;
use Twig\Environment;

class HomeController  extends AbstractContoller{
    public function __construct(
        private readonly YouTubeService $youtube
    ) {
        
    }
    public function index():Response{
        // dd($this->container->get('twig'));
        $content = "<h1>TEST controller</h1>";
        $content .= '<a href="{{ youTubeChannel }}">Youtube</a>';
        return $this->render($content,['youTubeChannel'=>$this->youtube->getChannelUrl()]);
    }
}