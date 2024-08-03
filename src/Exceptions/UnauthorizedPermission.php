<?php

namespace Ruff0\Permission\Exceptions;

/**
 * Class UnauthorizedPermission
 * @package Ruff0\Permission\Exceptions
 */
class UnauthorizedPermission extends UnauthorizedException
{
    /**
     * UnauthorizedPermission constructor.
     *
     * @param $statusCode
     * @param string|null $message
     * @param array $requiredPermissions
     */
    public function __construct($statusCode, string $message = null, array $requiredPermissions = [])
    {
        parent::__construct($statusCode, $message, [], $requiredPermissions);
    }
}
