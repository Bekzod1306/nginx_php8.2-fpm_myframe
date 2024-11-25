<?php

namespace App\Controllers;

use App\Services\YouTubeService;
use Bek\Framework\Controller\AbstractContoller;
use Bek\Framework\Http\Response;
use Twig\Environment;

class PostController  extends AbstractContoller{
    public function index():Response{
        return $this->render('posts.html.twig',[]);
    }
    public function create():Response{
        return $this->render('crate_post.html.twig',[]);
    }
}