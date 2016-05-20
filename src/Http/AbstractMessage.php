<?php
/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Http;

use mhndev\NanoFramework\Http\Interfaces\iMessage;
use mhndev\NanoFramework\Http\Exceptions\InvalidHttpVersion;
use mhndev\NanoFramework\Http\Interfaces\iStream;

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
     * @var string
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
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return AbstractMessage
     */
    public function withBody(iStream $body)
    {
        $clone = clone $this;

        $clone->body = $body;

        return $clone;
    }
}
