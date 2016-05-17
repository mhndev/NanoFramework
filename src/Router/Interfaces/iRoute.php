<?php

namespace mhndev\NanoFramework\Router\Interfaces;

interface iRoute
{
    /**
     * @param string $name
     * @return $this
     */
    function setName($name);

    /**
     * @return string
     */
    function getName();

    /**
     * @return mixed
     */
    function getMethod();

    /**
     * @param string $method
     * @return $this
     */
    function setMethod($method);

    /**
     * @return mixed
     */
    function getPattern();

    /**
     * @return mixed
     */
    function getCallable();

    /**
     * @param string $pattern
     * @return $this
     */
    function setPattern($pattern);
}
