<?php

namespace mhndev\NanoFramework\Http;

use mhndev\NanoFramework\Http\Interfaces\iRequest;

class Request extends AbstractMessage implements iRequest
{

    /**
     * The request method
     *
     * @var string
     */
    protected $method;


    /**
     * request URI
     */
    protected $uri;


    /**
     * request URI target (path + query string)
     *
     * @var string
     */
    protected $requestTarget;


    /**
     * The request query string params
     *
     * @var array
     */
    protected $queryParams;


    /**
     * The request cookies
     *
     * @var array
     */
    protected $cookies;


    /**
     * The server environment variables at the time the request was created.
     *
     * @var array
     */
    protected $serverParams;


    /**
     * The request body parsed (if possible) into a PHP array or object
     *
     * @var null|array|object
     */
    protected $bodyParsed = false;


    /**
     * @var
     */
    protected $parsedBody;

    /**
     * List of request body parsers (e.g., url-encoded, JSON, XML, multipart)
     *
     * @var callable[]
     */
    protected $bodyParsers = [];



    /**
     * List of uploaded files
     *
     * @var array files
     */
    protected $files;



    public static $validMethods = ['CONNECT', 'DELETE', 'GET', 'HEAD', 'OPTIONS', 'PATCH', 'POST', 'PUT', 'TRACE'];


    public function __construct(
        $method,
        $uri,
        array $headers,
        array $cookies,
        array $serverParams,
        $body,
        array $files = []
    )
    {
        $this->method       = $method;
        $this->uri          = $uri;
        $this->headers      = $headers;
        $this->cookies      = $cookies;
        $this->serverParams = $serverParams;
        $this->body         = $body;
        $this->files        = $files;
    }


    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }



    /**
     * @return array
     */
    public function getServerParams()
    {
        return $this->serverParams;
    }

    /**
     * @param array $serverParams
     * @return Request
     */
    public function withServerParams(array $serverParams)
    {
        $clone = clone $this;
        $clone->serverParams = $serverParams;

        return $clone;
    }


    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return Request
     */
    public function withMethod($method)
    {
        $clone = clone $this;

        $clone->method = $method;

        return $clone;
    }


    /**
     * @param $method
     * @return bool
     */
    public function isMethod($method)
    {
        return $this->getMethod() === $method;
    }

    /**
     * @param $name
     * @param $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        if(strpos('is', $name) != false && in_array(substr($name,2 ,strlen($name)), self::$validMethods )  ){
            return $this->isMethod(substr($name,2 ,strlen($name)));
        }
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param $uri
     * @return Request
     */
    public function withUri($uri)
    {
        $clone = clone $this;
        
        $clone->uri = $uri;
        
        return $clone;
    }


    /**
     * Is this an XHR (Ajax) request?
     *
     * @return bool
     */
    public function isXhr()
    {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')

            return true;
        else
            return false;
    }

    /**
     * @return mixed
     */
    public function getParsedBody()
    {
        if($this->bodyParsed)
            return $this->parsedBody;

        else
            return $this->parseBody()->getParsedBody();
    }

    /**
     * @return $this
     */
    public function parseBody()
    {
        $this->bodyParsed = true;


        $parsedBody = '';

        $this->parsedBody = $parsedBody;

        return $this;
    }

    /**
     * @param $parsedBody
     * @return Request
     */
    public function withParsedBody($parsedBody)
    {
        $clone = clone $this;
        $clone->parsedBody = $parsedBody;
        $clone->bodyParsed = true;

        return $clone;
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @param $queryParams
     * @return Request
     */
    public function withQueryParams($queryParams)
    {
        $clone = clone $this;

        $clone->queryParams = $queryParams;

        return $clone;
    }
}
