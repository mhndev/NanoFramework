<?php

namespace mhndev\NanoFramework\Router\Interfaces;

interface iRouter
{

    /**
     * @param string $pattern
     * @return iRoute
     */
    function match($pattern);


    /**
     * @param iRoute $route
     * @return $this
     */
    function register(iRoute $route);


    /**
     * @param iRoute $route
     * @return $this
     */
    function remove(iRoute $route);


    /**
     * @param array $routes
     * @return $this
     */
    function setRoutes(array $routes);
}
