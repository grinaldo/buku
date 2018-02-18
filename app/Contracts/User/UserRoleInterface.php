<?php

namespace App\Contracts\User;

/**
 * Interface User Role Definitions
 */
interface UserRoleInterface
{
    const SUPER_ADMIN = 'super_admin';
    const ADMIN       = 'admin';
    const MODERATOR   = 'moderator';
    const MASTER_USER = 'master_user';
    const CHILD_USER  = 'child_user';
}
