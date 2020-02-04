<?php

namespace bryanthw1020\LiveVideoBroadcastManager\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class LiveVideoBroadcastManagerException extends HttpException
{
    /**
     * @param int $statusCode The internal exception code
     * @param string $message The internal exception message
     */
    public function __construct(int $statusCode = 400, string $message = null)
    {
        parent::__construct($statusCode, $message);
    }
}