<?php

namespace Bek\Framework\Http;

use Bek\Framework\Http\Exceptions\HttpException;
use Bek\Framework\Routing\RouterInterface;
use Doctrine\DBAL\Connection;
use Exception;
use League\Container\Container;
use Throwable;

use function FastRoute\simpleDispatcher;

class Kernel{
    private $appEnv = 'local';
    public function __construct(
        private RouterInterface $router,
        private Container $container
    )
    {
        $this->appEnv = $this->container->get('APP_ENV');
    }
    public function handle(Request $request):Response
    {

        try{
            // $con = $this->container->get(Connection::class);
            // $sql = "SELECT * FROM test";

            // // Выполняем запрос
            // $result = $con->fetchAllAssociative($sql);
            // dd($result);
            [$routeHandler,$vars] = $this->router->dispatch($request,$this->container);

            $response = call_user_func_array($routeHandler,$vars);
            
        }catch(Exception $e){
            $response = $this->createExceptionResponse($e);
        }
        return $response;
        
    }

    private function createExceptionResponse(Exception $e):Response
    {
        if(in_array($this->appEnv,['local','testing'])){
            throw $e;
        }
        if($e instanceof HttpException){
            return new Response($e->getMessage(),$e->getStatusCode());
        }

        return new Response('Server error',500);
    }
}