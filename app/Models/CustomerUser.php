<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUser extends Model
{
    use HasFactory;

    protected $table = 'customer_users';

    protected $fillable = [
        'name',
        'position',
        'status',
        'matching',
        'created_at'
    ];
}
