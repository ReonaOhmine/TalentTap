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
        'created_at',
        'age',
        'gender',
        'desired_salary_min',
        'desired_salary_max',
        'catch_copy',
        'career_description',
        'num_companies_worked',
        'skill_distribution',
        'notable_achievements',
        'recommendation',
        'initial' // 新しいフィールドを追加
    ];
}
