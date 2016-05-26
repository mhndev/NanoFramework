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

use mhndev\NanoFramework\Http\Interfaces\iRequest;
use mhndev\NanoFramework\Http\Interfaces\iResponse;

class Http
{
    /**
     * @var iRequest
     */
    protected $request;


    /**
     * @var iResponse
     */
    protected $response;


    /**
     * @return iRequest|Request
     */
    function createRequestFromGlobals()
    {
        $serverParams = $_SERVER;
        
        $uri          = strtok($_SERVER["REQUEST_URI"],'?');
        $method       = $_SERVER['REQUEST_METHOD'];
        $headers      = $this->parseRequestHeaders($serverParams);
        $cookies      = $_COOKIE;
        $body         = $entityBody = file_get_contents('php://input');
        $files        = $_FILES;
        $queryParams  = $_GET;

        //$body         = http_get_request_body();
        //$body         = stream_get_contents(STDIN);


        $this->request = new Request($method, $uri,$queryParams, $headers, $cookies, $serverParams, $body, $files);

        return $this->request;
    }

    /**
     * @return iRequest
     */
    public function request()
    {
        return $this->request;
    }


    /**
     * @return iResponse
     */
    public function response()
    {
        return $this->response;
    }


    /**
     * @param array $serverParams
     * @return array
     */
    protected function parseRequestHeaders(array $serverParams)
    {
        $headers = array();
        foreach($serverParams as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        return $headers;
    }
}
