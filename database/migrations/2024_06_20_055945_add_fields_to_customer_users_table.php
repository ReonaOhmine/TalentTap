<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCustomerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->integer('age')->nullable(); // 年齢
            $table->string('gender')->nullable(); // 性別
            $table->integer('desired_salary_min')->nullable(); // 希望年収（下限）
            $table->integer('desired_salary_max')->nullable(); // 希望年収（上限）
            $table->string('catch_copy', 60)->nullable(); // 経歴キャッチコピー
            $table->string('career_description', 250)->nullable(); // 経歴概要
            $table->integer('num_companies_worked')->nullable(); // 経験社数
            $table->json('skill_distribution')->nullable(); // スキル分布（低〜高）
            $table->text('notable_achievements')->nullable(); // 特筆実績
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->dropColumn('gender');
            $table->dropColumn('desired_salary_min');
            $table->dropColumn('desired_salary_max');
            $table->dropColumn('catch_copy');
            $table->dropColumn('career_description');
            $table->dropColumn('num_companies_worked');
            $table->dropColumn('skill_distribution');
            $table->dropColumn('notable_achievements');
        });
    }
}
