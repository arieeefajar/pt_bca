<?php

namespace App\Constants;

class RoleType
{
    const SUPER_ADMIN =  "super-admin";
    const ADMIN =  "admin";
    const EXECUTIVE =  "executive";
    const USER =  "user";
    const ALL = [
        self::SUPER_ADMIN,
        self::ADMIN,
        self::EXECUTIVE,
        self::USER,
    ];
}
