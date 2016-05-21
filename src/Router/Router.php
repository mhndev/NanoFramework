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
     * @param string $uri
     * @param string $method
     * @return iRoute
     * @throws RouteNotFound
     */
    function match($uri, $method)
    {
        /** @var iRoute $route */
        foreach ($this->routes as $route){
            if($route->getMethod() == $method && $params = $this->matchUriWithRoute($uri, $route)){
                return $route->setUriParams($params);
            }
        }

        throw new RouteNotFound;
    }

    /**
     * @param $uri
     * @param iRoute $route
     * @return false|array
     */
    protected function matchUriWithRoute($uri, iRoute $route)
    {
        $condition = $this->startsWith(
            $fixedPart = $this->getUriWithoutParameters($route->getPattern()),
            $uri
        );

        if(!$condition)
            return false;

        else{
            $routeParams = $this->getPatternParameters($route->getPattern());
            $countRouteParams = count($routeParams);

            $other = $this->pureUri(substr($uri, strlen($fixedPart), strlen($uri)) );
            $uriParams = explode('/' ,$other);

            $countUriParams = (!$other) ? 0 : count(explode('/' ,$other));

            if($countUriParams != $countRouteParams)
                return false;
        }

        return $this->formatParams($routeParams, $uriParams);
    }


    /**
     * @param array $routeParams
     * @param array $uriParams
     * @return array
     */
    protected function formatParams(array $routeParams , array $uriParams)
    {
        $result = [];

        for($i = 0; $i<count($routeParams); $i++){
            $result[$routeParams[$i]] = $uriParams[$i];
        }

        return $result;
    }

    /**
     * @param $pattern
     * @return string
     */
    protected function getUriWithoutParameters($pattern)
    {
        if ($position = strpos($pattern, '{') !== false)
            return substr($pattern, 0, strlen($pattern) - strpos($pattern, '{') + 2);
        else
            return $pattern;

    }


    /**
     * @param string $needle
     * @param string $string
     * @return bool
     */
    protected function startsWith($needle, $string)
    {
        return (0 === strpos($string, $needle));
    }

    /**
     * @param $pattern
     * @return array
     */
    protected function getPatternParameters($pattern)
    {
        $pattern = $this->pureUri($pattern);
        $position = strpos($pattern, '{');

        if ($position === false)
            return [];


        else{
            $paramsString = substr($pattern, $position, strlen($pattern) - $position);

            $params = explode('/', $paramsString);

            array_walk($params, function(&$item, $key){
                $item = substr($item, 1, strlen($item) -2);
            });
            return $params;

        }
    }

    /**
     * @param string $uri
     * @return mixed
     */
    protected function pureUri($uri)
    {
        return rtrim(ltrim($uri,'/'),'/');
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
