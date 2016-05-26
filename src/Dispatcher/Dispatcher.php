<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
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

            if(!empty($route->getUriParams())){
                $ActionArguments = implode(',',$route->getUriParams());
                $result = $controller->{$items[1]}($ActionArguments);
            }else
                $result = $controller->{$items[1]}();

            return $result;
        }

        if($callable instanceof \Closure){

            \Closure::bind($callable, $this->container);
            $callable($this->container);
        }
    }

}
