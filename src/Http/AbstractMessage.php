<?php

namespace mhndev\NanoFramework\Http;

use mhndev\NanoFramework\Http\Interfaces\iMessage;
use mhndev\NanoFramework\Http\Exceptions\InvalidHttpVersion;

abstract class AbstractMessage implements iMessage
{



    /**
     * Protocol version
     *
     * @var string
     */
    protected $protocolVersion = '1.1';


    /**
     * Headers
     */
    protected $headers;


    /**
     * Body
     */
    protected $body;


    /**
     * Disable magic setter to ensure immutability
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        // Do nothing
    }


    /**
     * @return string
     */
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * @param $version
     * @return AbstractMessage
     * @throws InvalidHttpVersion
     */
    public function withProtocolVersion($version)
    {
        if(!in_array($version, ['1.0','1.1','2.0'])){
            throw new InvalidHttpVersion;
        }
        $clone = clone $this;
        $clone->protocolVersion = $version;
        return $clone;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function hasHeader($name)
    {
        return in_array($name, array_keys($this->headers) );
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        return $this->headers[$name];
    }

    /**
     * @param $name
     * @param $value
     * @return AbstractMessage
     */
    public function withHeader($name, $value)
    {
        $clone = clone $this;

        $clone->headers[$name] = $value;

        return $clone;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $body
     * @return AbstractMessage
     */
    public function withBody($body)
    {
        $clone = clone $this;

        $clone->body = $body;

        return $clone;
    }
}
