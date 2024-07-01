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
        'initial',
        'birthday',
        'gender',
        'position',
        'catch_copy',
        'career_description',
        'recommendation',
        'desired_salary_min',
        'desired_salary_max',
        'skill_distribution',
        'skill_distribution_1',
        'skill_distribution_2',
        'skill_distribution_3',
        'skill_comment_1',
        'skill_comment_2',
        'skill_comment_3',
        'num_companies_worked',
        'work_preference',
        'notable_achievements',
        'status',
        'matching',
        'created_at'
    ];

    protected $casts = [
        'work_preference' => 'array',
    ];
}
