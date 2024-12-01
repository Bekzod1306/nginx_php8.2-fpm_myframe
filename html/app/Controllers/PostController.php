<?php

namespace App\Controllers;

use App\Entities\Post;
use App\Services\PostService;
use App\Services\YouTubeService;
use Bek\Framework\Controller\AbstractContoller;
use Bek\Framework\Http\RedirectResponse;
use Bek\Framework\Http\Request;
use Bek\Framework\Http\Response;
use Twig\Environment;

class PostController  extends AbstractContoller
{
    public function __construct(private PostService $service) {}
    public function index(): Response
    {
        return $this->render('posts.html.twig', []);
    }
    public function show(int $id):Response{
        $post = $this->service->findOrFail($id);
        return $this->render('show_posts.html.twig', [
            'post'=>$post
        ]);
    }
    public function create(): Response
    {
        return $this->render('crate_post.html.twig', []);
    }
    public function store(): Response
    {
        $post = Post::create($this->request->postData['title'], $this->request->postData['body']);
        $post = $this->service->save($post);
        return new RedirectResponse("/posts/{$post->getId()}");
    }
}
