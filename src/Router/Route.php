<?php

namespace mhndev\NanoFramework\Router;

use mhndev\NanoFramework\Router\Interfaces\iRoute;

class Route implements iRoute
{


    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $pattern;


    /**
     * @var mixed
     */
    protected $callable;


    /**
     * Route constructor.
     * @param $name
     * @param $method
     * @param $pattern
     * @param $callable
     */
    public function __construct($name, $method, $pattern, $callable)
    {
        $this->name = $name;
        $this->method = $method;
        $this->pattern = $pattern;
        $this->callable = $callable;
    }

    /**
     * @param string $name
     * @return $this
     */
    function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return mixed
     */
    function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return $this
     */
    function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return mixed
     */
    function getCallable()
    {
        return $this->callable;
    }
}
