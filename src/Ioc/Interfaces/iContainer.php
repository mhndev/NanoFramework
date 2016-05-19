<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Ioc\Interfaces;

interface iContainer
{
    /**
     * iContainer constructor.
     * @param array $services
     */
    function __construct(array $services);


    /**
     * @param string $serviceName
     * @return mixed
     */
    function get($serviceName);

    /**
     * @param string $serviceName
     * @param mixed $service
     * @return $this
     */
    function set($serviceName, $service);

    /**
     * @param $serviceName
     * @return boolean
     */
    function exist($serviceName);
}
