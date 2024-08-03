<?php

namespace Ruff0\Permission\Contracts;

use Ruff0\Permission\Exceptions\PermissionDoesNotExist;

/**
 * Interface PermissionInterface
 * @package Ruff0\Permission\Contracts
 */
interface PermissionInterface
{
    /**
     * A permission can be applied to roles.
     */
    public function rolesQuery();

    /**
     * Find a permission by its name.
     *
     * @param string $name
     * @param string $guardName
     *
     * @throws PermissionDoesNotExist
     *
     * @return PermissionInterface
     */
    public static function findByName(string $name, string $guardName): PermissionInterface;
}
