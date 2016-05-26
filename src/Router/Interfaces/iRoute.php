<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */


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

    /**
     * @return array
     */
    function getUriParams();

    /**
     * @param array $params
     * @return mixed
     */
    function setUriParams(array $params);
}
