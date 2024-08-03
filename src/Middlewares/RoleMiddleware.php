<?php

namespace Ruff0\Permission\Middlewares;

use Closure;
use Ruff0\Permission\Exceptions\UnauthorizedException;
use Ruff0\Permission\Exceptions\UnauthorizedRole;
use Ruff0\Permission\Exceptions\UserNotLoggedIn;
use Ruff0\Permission\Helpers;
use function explode;
use function is_array;

/**
 * Class RoleMiddleware
 * @package Ruff0\Permission\Middlewares
 */
class RoleMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     *
     * @return mixed
     * @throws UnauthorizedException
     */
    public function handle($request, Closure $next, $role): mixed
    {
        if (app('auth')->guest()) {
            $helpers = new Helpers();
            throw new UserNotLoggedIn(403, $helpers->getUserNotLoggedINMessage());
        }

        $roles = is_array($role) ? $role : explode('|', $role);

        if (! app('auth')->user()->hasAnyRole($roles)) {
            $helpers = new Helpers();
            throw new UnauthorizedRole(403, $helpers->getUnauthorizedRoleMessage(implode(', ', $roles)), $roles);
        }

        return $next($request);
    }
}
