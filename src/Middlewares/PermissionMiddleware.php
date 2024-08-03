<?php

namespace Ruff0\Permission\Middlewares;

use Closure;
use Ruff0\Permission\Exceptions\UnauthorizedException;
use Ruff0\Permission\Exceptions\UnauthorizedPermission;
use Ruff0\Permission\Exceptions\UserNotLoggedIn;
use Ruff0\Permission\Helpers;
use function explode;
use function is_array;

/**
 * Class PermissionMiddleware
 * @package Ruff0\Permission\Middlewares
 */
class PermissionMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     *
     * @return mixed
     * @throws UnauthorizedException
     */
    public function handle($request, Closure $next, $permission): mixed
    {
        if (app('auth')->guest()) {
            $helpers = new Helpers();
            throw new UserNotLoggedIn(403, $helpers->getUserNotLoggedINMessage());
        }

        $permissions = is_array($permission) ? $permission : explode('|', $permission);


        if (! app('auth')->user()->hasAnyPermission($permissions)) {
            $helpers = new Helpers();
            throw new UnauthorizedPermission(
                403,
                $helpers->getUnauthorizedPermissionMessage(implode(', ', $permissions)),
                $permissions
            );
        }

        return $next($request);
    }
}
