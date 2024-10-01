<?php

namespace Bek\Framework\Routing;

use Bek\Framework\Http\Request;

interface RouterInterface {
	public function dispatch(Request $request);
}