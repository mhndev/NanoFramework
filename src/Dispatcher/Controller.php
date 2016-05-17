<?php

namespace mhndev\NanoFramework\Dispatcher;


use mhndev\NanoFramework\Http\Interfaces\iRequest;
use mhndev\NanoFramework\Http\Interfaces\iResponse;
use mhndev\NanoFramework\Ioc\iContainer;
use mhndev\NanoFramework\Router\Interfaces\iRoute;

class Controller
{

    /**
     * @var iContainer
     */
    protected $container;

    /**
     * @var iRequest
     */
    protected $request;

    /**
     * @var iResponse
     */
    protected $response;


    public function __construct(iContainer $container)
    {
        $this->container = $container;
        $this->request = $this->container->get('http')->request();
        $this->response = $this->container->get('http')->response();

    }

    /**
     * @param $routeName
     */
    public function redirect($routeName)
    {
        $routes = $this->container->get('router')->getRoutes();

        /** @var iRoute $route */
        $route = $routes[$routeName];

        header("Location: ".$this->baseUrl().'/'.$route->getPattern());
        die();
    }

    /**
     * @return iRequest
     */
    public function request()
    {
        return $this->container->get('request');
    }

    /**
     * @return iResponse
     */
    public function response()
    {
        return $this->container->get('request');

    }

    public function url()
    {
        $server = $this->request->getServerParams();


        return sprintf(
            "%s://%s%s",
            isset($server['HTTPS']) && $server['HTTPS'] != 'off' ?
                'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }


    public function baseUrl()
    {
        $server = $this->request->getServerParams();


        return sprintf(
            "%s://%s%s",
            isset($server['HTTPS']) && $server['HTTPS'] != 'off' ?
                'https' : 'http',
            $server['SERVER_NAME'],
            $server['REQUEST_URI']
        );
    }


}
