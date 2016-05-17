<?php

namespace mhndev\NanoFramework\Ioc;

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
}
