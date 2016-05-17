<?php

namespace mhndev\NanoFramework\Http\Interfaces;

interface iMessage
{


    public function getProtocolVersion();


    public function withProtocolVersion($version);


    public function getHeaders();


    public function hasHeader($name);

    public function getHeader($name);

    public function withHeader($name, $value);

    public function getBody();


    public function withBody($body);

}
