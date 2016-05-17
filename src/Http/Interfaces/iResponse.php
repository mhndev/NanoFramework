<?php

namespace mhndev\NanoFramework\Http\Interfaces;

interface iResponse extends iMessage
{
    public function getStatusCode();

    public function withStatusCode($code);
}
