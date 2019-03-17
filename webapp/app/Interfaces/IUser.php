<?php

namespace App\Interfaces;

/**
 * Interface IUser
 *
 * @package App\Interfaces
 */
interface IUser
{
    const ROLE_USER = 'normal';
    const ROLE_ADMIN = 'admin';

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role) : bool;
}
