<?php

namespace Bek\Framework\Routing;

use Bek\Framework\Http\Request;
use League\Container\Container;

interface RouterInterface {
	public function dispatch(Request $request,Container $container);

	public function registerRoutes(array $routes);
}