<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Kernel\Http;

use mhndev\NanoFramework\Dispatcher\Interfaces\iDispatcher;
use mhndev\NanoFramework\Http\Interfaces\iRequest;
use mhndev\NanoFramework\Http\Interfaces\iResponse;
use mhndev\NanoFramework\Ioc\Interfaces\iContainer;
use mhndev\NanoFramework\Router\Interfaces\iRouter;
use mhndev\NanoFramework\Router\Route;

class Kernel
{


    const VERSION = '1.0';

    /**
     * @var iRouter
     */
    protected $router;


    /**
     * @var iDispatcher
     */
    protected $dispatcher;

    /**
     * @var
     */
    protected $events;

    /**
     * @var iContainer
     */
    protected $container;


    /**
     * Kernel constructor.
     * @param iRouter|null $router
     * @param iDispatcher|null $dispatcher
     * @param iContainer|null $container
     */
    public function __construct(iRouter $router = null , iDispatcher $dispatcher = null, iContainer $container = null)
    {
        $this->router = $router ? $router : $this->container->get('router');
        $this->dispatcher = $dispatcher ? $dispatcher : $this->container->get('dispatcher');
        $this->container = $container;
    }


    /**
     * Run application
     *
     * This method traverses the application middleware stack and then sends the
     * resultant Response object to the HTTP client.
     *
     * @param iRequest $request
     * @return iResponse
     */
    public function run($request)
    {
        $route    = $this->router->match($request->getUri());
        
        $response = $this->dispatcher->dispatch($route);

        return $this->respond($response);
    }


    /**
     * Send the response the client
     *
     * @param iResponse $response
     * @return iResponse
     */
    public function respond(iResponse $response)
    {
        // Send response
        if (!headers_sent()) {
            // Status
            header(sprintf(
                'HTTP/%s %s %s',
                $response->getProtocolVersion(),
                $response->getStatusCode()
            ));
            // Headers
            foreach ($response->getHeaders() as $name => $values) {
                foreach ($values as $value) {
                    header(sprintf('%s: %s', $name, $value), false);
                }
            }
        }

        return $response;
    }


    /**
     * @param $pattern
     * @param $name
     * @param $method
     * @param $callable
     * @return $this
     */
    public function route($pattern , $name, $method, $callable)
    {
        $this->router->register(new Route($name, $method, $pattern, $callable));

        return $this;
    }


    /********************************************************************************
     * Router proxy methods
     *******************************************************************************/


    /**
     * @param $name
     * @param $arguments
     * @return $this
     */
    public function __call($name, $arguments)
    {
        $name = strtoupper($name);

        if(in_array($name, ['GET','POST','HEAD','PATH','PUT','DELETE', 'OPTIONS']) ){
            return $this->route($arguments[0], $arguments[1], $name, $arguments[2]);
        }
    }




    public function setRoutes(array $routes)
    {
        $this->router->setRoutes($routes);

        return $this;
    }


    /**
     * @return iRouter
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param iRouter $router
     * @return $this
     */
    public function setRouter(iRouter $router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * @return iDispatcher
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    /**
     * @param iDispatcher $dispatcher
     * @return $this
     */
    public function setDispatcher(iDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @return iContainer
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param iContainer $container
     * @return $this
     */
    public function setContainer(iContainer $container)
    {
        $this->container = $container;

        return $this;
    }



}
