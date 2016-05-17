<?php
/**
 * Created by PhpStorm.
 * User: Majid
 * Date: 5/16/2016
 * Time: 12:47 PM
 */

namespace mhndev\NanoFramework\Dispatcher;

use mhndev\NanoFramework\Dispatcher\Interfaces\iDispatcher;
use mhndev\NanoFramework\Http\Interfaces\iResponse;
use mhndev\NanoFramework\Ioc\Interfaces\iContainer;
use mhndev\NanoFramework\Router\Interfaces\iRoute;

class Dispatcher implements iDispatcher
{

    /**
     * @var iContainer
     */
    protected $container;

    /**
     * Dispatcher constructor.
     * @param iContainer $container
     */
    public function __construct(iContainer $container)
    {
        $this->container = $container;
    }

    /**
     * @param iRoute $route
     *
     * @return iResponse
     */
    function dispatch(iRoute $route)
    {
        if(is_string($callable = $route->getCallable())){
            $items = explode('@',$callable );

            $controller = new $items[0]($this->container);
            $result = $controller->{$items[1]}();

            return $result;
        }

        if($callable instanceof \Closure){

            \Closure::bind($callable, $this->container);
            $callable($this->container);
        }
    }

}
