<?php

namespace App\Controllers;

use App\Services\YouTubeService;
use Bek\Framework\Controller\AbstractContoller;
use Bek\Framework\Http\Response;
use Doctrine\DBAL\DriverManager;
use Twig\Environment;

class HomeController  extends AbstractContoller{
    public function __construct(
        private readonly YouTubeService $youtube
    ) {
        
    }
    public function index():Response{
        // dd(123);
        // dd($this->container->get('twig'));
        return $this->render('home.html.twig',['youTubeChannel'=>$this->youtube->getChannelUrl()]);
    }
}