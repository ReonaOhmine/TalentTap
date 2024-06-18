<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EmployerUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        // 'company_name',
        // 'position',
        // 'name',
        'email',
        // 'tel',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
