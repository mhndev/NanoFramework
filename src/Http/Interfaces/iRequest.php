<?php

namespace mhndev\NanoFramework\Http\Interfaces;


interface iRequest extends iMessage
{

    public function getRequestTarget();
    
    
    public function withRequestTarget($requestTarget);

    public function getMethod();


    public function withMethod($method);


    public function getUri();

    public function withUri($uri);


    public function getParsedBody();

    public function withParsedBody($parsedBody);
    
    /**
     * @return $this
     */
    public function parseBody();
    /**
     * @return array
     */
    public function getQueryParams();


    /**
     * @return array
     */
    public function getServerParams();


    /**
     * @param array $serverParams
     * @return iRequest
     */
    public function withServerParams(array $serverParams);
}
