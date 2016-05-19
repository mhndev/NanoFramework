<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Ioc;

use mhndev\NanoFramework\Ioc\Exceptions\ServiceClassNotFound;
use mhndev\NanoFramework\Ioc\Exceptions\ServiceNotFound;
use mhndev\NanoFramework\Ioc\Interfaces\iContainer;

class Container implements iContainer
{
    
    /**
     * @var array
     */
    private $services;


    /**
     * iContainer constructor.
     * @param array $config
     * @throws ServiceClassNotFound
     * @throws ServiceNotFound
     */
    public function __construct(array $config)
    {

        $this->services['container'] = $this;


        foreach ($config as $serviceName => $serviceData){

            if(!class_exists($serviceData['class'])){
                throw new ServiceClassNotFound;
            }
            
            if(!empty($serviceData['arguments']) ){

                $arguments = [];
                foreach ($serviceData['arguments'] as $argument ){
                    $requiredServiceName = substr($argument, 1 , strlen($argument) );
                    
                    if(!$this->exist($requiredServiceName))
                        throw new ServiceNotFound;
                        
                    $arguments[] = $this->get($requiredServiceName);
                }

                $reflection = new \ReflectionClass($serviceData['class']);
                $this->services[$serviceName] = $reflection->newInstanceArgs($arguments);


            }
            else{
                $this->services[$serviceName] = new $serviceData['class'];
            }

            if(!empty($serviceData['calls'])){
                $neededServiceName = substr($serviceData['calls'][1], 1, strlen($serviceData['calls'][1]));

                if(!$this->exist($neededServiceName))
                    throw new ServiceNotFound;

                if(method_exists($this->services[$serviceName], $serviceData['calls'][0]))
                    throw new \BadMethodCallException;

                $this->services[$serviceName]->{$serviceData['calls'][0]}($this->get($neededServiceName));
            }

        }



    }

    /**
     * @param string $serviceName
     * @return mixed
     */
    function get($serviceName)
    {
        return $this->services[$serviceName];
    }

    /**
     * @param string $serviceName
     * @param mixed $service
     * @return $this
     */
    function set($serviceName, $service)
    {
        $this->services[$serviceName] = $serviceName;
    }

    /**
     * @param $serviceName
     * @return boolean
     */
    function exist($serviceName)
    {
        return !empty($this->services[$serviceName]);
    }
}
