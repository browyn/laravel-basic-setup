<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case USER = "USER";
    case ADMIN = "USER_ADMIN";
    case CREATOR = "USER_CREATOR";
    case SUPER_ADMIN = "USER_SUPER_ADMIN";
}
