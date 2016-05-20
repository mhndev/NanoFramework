<?php

/*
 * This file is part of mhndev/nano-framework.
 *
 * (c) Majid Abdolhosseini <majid8911303@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace mhndev\NanoFramework\Http\Interfaces;

/**
 * Interface iMessage
 * @package mhndev\NanoFramework\Http\Interfaces
 *
 * An HTTP message is either a request from a client to a server or a response from a server to a client.
 * This specification defines interfaces for the HTTP messages
 *
 */
interface iMessage
{


    /**
     * @return string
     */
    public function getProtocolVersion();


    /**
     * @param $version
     * @return $this
     */
    public function withProtocolVersion($version);


    /**
     * @return array
     */
    public function getHeaders();


    /**
     * @param string $name
     * @return boolean
     */
    public function hasHeader($name);

    /**
     * @param string $name
     * @return string
     */
    public function getHeader($name);

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function withHeader($name, $value);

    /**
     * @return string
     */
    public function getBody();


    /**
     * @param string $body
     * @return $this
     */
    public function withBody($body);

}
