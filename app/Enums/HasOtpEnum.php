<?php

namespace App\Enums;

enum HasOtpEnum: string
{
    case EMAIL_VERIFICATION = 'email_verification';
    case TWO_FACTOR_AUTHENTICATION = 'two_factor_authentication';
}
