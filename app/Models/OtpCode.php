<?php

namespace App\Models;

use App\Enums\HasOtpEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'for',
        'otp',
        'expires_at',
    ];

    protected $cast = [
        'for' => HasOtpEnum::class,
        'expires_at' => 'datetime',
    ];
}
