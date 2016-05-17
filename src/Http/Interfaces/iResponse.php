<?php

namespace mhndev\NanoFramework\Http\Interfaces;

interface iResponse extends iMessage
{
    /**
     * @return mixed
     */
    public function getStatusCode();

    /**
     * @param $code
     * @return mixed
     */
    public function withStatusCode($code);
}
