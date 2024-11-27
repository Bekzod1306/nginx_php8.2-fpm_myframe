<?php

use Bek\Framework\Console\Application;
use Bek\Framework\Console\Kernel as ConsoleKernel;
use Bek\Framework\Controller\AbstractContoller;
use Bek\Framework\Dbal\ConnectionFactory;
use Bek\Framework\Http\Kernel;
use Bek\Framework\Routing\Router;
use Bek\Framework\Routing\RouterInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Tools\DsnParser;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH.'/.env');
$appEnv = $_ENV['APP_ENV']??'local';
$viewsPath = BASE_PATH.'/views';
$databaseUrl = 'pdo-pgsql://root:r00t@db:5432/my_db?charset=utf8mb4';
$routes = include BASE_PATH . '/routes/web.php';

$container = new Container();
$container->delegate(new ReflectionContainer(true));
$container->add('framework-commands-namespace',new StringArgument('Bek\\Framework\\Console\\Commands\\'));
$container->add('APP_ENV',new StringArgument($appEnv));
$container->add(RouterInterface::class,Router::class);
$container->extend(RouterInterface::class)->addMethodCall('registerRoutes',[new ArrayArgument($routes)]);
$container->add(Kernel::class)->addArgument(RouterInterface::class)->addArgument($container);
$container->addShared('twig-loader',FilesystemLoader::class)->addArgument(new StringArgument($viewsPath));
$container->addShared('twig',Environment::class)->addArgument('twig-loader');
$container->inflector(AbstractContoller::class)->invokeMethod('setContainer',[$container]);
$container->add(ConnectionFactory::class)->addArgument(new StringArgument($databaseUrl));
$container->addShared(Connection::class,function() use ($container):Connection{
    return $container->get(ConnectionFactory::class)->create();
});
$container->add(Application::class)->addArgument($container);
$container->add(ConsoleKernel::class)->addArgument($container)->addArgument(Application::class);
// $container->has();
return $container;