<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case ADMIN = 'ADMIN';
    case CONTENT_MANAGER = 'CONTENT_MANAGER';

    /**
     * Determine if the role grants full administrative control.
     */
    public function isSuperAdmin(): bool
    {
        return $this === self::SUPER_ADMIN;
    }

    /**
     * Determine if the role grants access to administrative features.
     */
    public function canAccessAdmin(): bool
    {
        return in_array($this, [
            self::SUPER_ADMIN,
            self::ADMIN,
            self::CONTENT_MANAGER,
        ], true);
    }
}
