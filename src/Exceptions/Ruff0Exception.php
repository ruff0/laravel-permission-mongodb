<?php

namespace Ruff0\Permission\Exceptions;

use InvalidArgumentException;
use Throwable;
use function app;
use function config;

/**
 * Class Ruff0Exception
 * @package Ruff0\Permission\Exceptions
 */
class Ruff0Exception extends InvalidArgumentException
{
    /**
     * Ruff0Exception constructor.
     *
     * @param string|null $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = null, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        if (config('permission.log_registration_exception')) {
            $logger = app('log');
            $logger->alert($message);
        }
    }
}
