<?php

namespace mhndev\NanoFramework\Ioc;

class Container implements iContainer
{
    
    /**
     * @var array
     */
    private $services;


    /**
     * iContainer constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {

        $this->services['container'] = $this;


        foreach ($config as $serviceName => $serviceData){

            if(!empty($serviceData['arguments']) ){

                $arguments = [];
                foreach ($serviceData['arguments'] as $argument ){
                    $arguments[] = $this->get(substr($argument, 1 , strlen($argument) ) );
                }

                $reflection = new \ReflectionClass($serviceData['class']);
                $this->services[$serviceName] = $reflection->newInstanceArgs($arguments);


            }
            else{
                $this->services[$serviceName] = new $serviceData['class'];

            }


            if(!empty($serviceData['calls'])){
                $neededServiceName = substr($serviceData['calls'][1], 1, strlen($serviceData['calls'][1]));
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
}
