<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Dispatcher\Interfaces;

use mhndev\NanoFramework\Http\Interfaces\iResponse;
use mhndev\NanoFramework\Router\Interfaces\iRoute;

interface iDispatcher
{
    /**
     * @param iRoute $route
     * @return iResponse
     */
    function dispatch(iRoute $route);
}
