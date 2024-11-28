<?php

namespace Bek\Framework\Controller;

use Bek\Framework\Http\Request;
use Bek\Framework\Http\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractContoller
{
    protected ?ContainerInterface $container = null;
    protected Request $request;
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function render(string $view, array $parameters = [], Response $response = null)
    {

        $content = $this->container->get('twig')->render($view, $parameters);

        $response ??= new Response();

        $response->setContent($content);

        return $response;
    }
}
