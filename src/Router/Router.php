<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Router;

use mhndev\NanoFramework\Router\Exceptions\RouteNotFound;
use mhndev\NanoFramework\Router\Interfaces\iRoute;
use mhndev\NanoFramework\Router\Interfaces\iRouter;

class Router implements iRouter
{

    /**
     * @var array of iRoute
     */
    protected $routes;


    /**
     * @param string $pattern
     * @return iRoute
     * @throws RouteNotFound
     */
    function match($pattern)
    {
        /** @var iRoute $route */
        foreach ($this->routes as $route){
            if($route->getPattern() == $pattern)
                return $route;
        }

        throw new RouteNotFound;
    }

    /**
     * @param iRoute $route
     * @return $this
     */
    function register(iRoute $route)
    {
        $this->routes[$route->getName()] = $route;

        return $this;
    }

    /**
     * @param iRoute $route
     * @return $this
     */
    function remove(iRoute $route)
    {
        unset($this->routes[$route->getName()]);

        return $this;
    }

    /**
     * @param array $routes
     * @return $this
     */
    function setRoutes(array $routes)
    {
        foreach ($routes as $route){
            $this->register($route);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
    
}
