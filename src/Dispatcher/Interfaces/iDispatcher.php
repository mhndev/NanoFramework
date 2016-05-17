<?php

namespace mhndev\NanoFramework\Dispatcher\Interfaces;

use mhndev\NanoFramework\Http\Interfaces\iResponse;
use mhndev\NanoFramework\Router\Interfaces\iRoute;

interface iDispatcher
{
    /**
     * @param iRoute $route
     * @return iResponse
     */
    function dispatch(iRoute $route);
}
