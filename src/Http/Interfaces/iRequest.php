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


interface iRequest extends iMessage
{

    /**
     * @return mixed
     */
    public function getRequestTarget();


    /**
     * @param $requestTarget
     * @return mixed
     */
    public function withRequestTarget($requestTarget);

    /**
     * @return mixed
     */
    public function getMethod();


    /**
     * @param $method
     * @return mixed
     */
    public function withMethod($method);


    /**
     * @return mixed
     */
    public function getUri();

    /**
     * @param $uri
     * @return mixed
     */
    public function withUri($uri);


    /**
     * @return mixed
     */
    public function getParsedBody();

    /**
     * @param $parsedBody
     * @return mixed
     */
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
