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
