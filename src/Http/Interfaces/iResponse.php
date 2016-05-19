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
