<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToCustomerUsersTable2 extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->string('skill_distribution_1')->nullable()->after('skill_distribution');
            $table->string('skill_distribution_2')->nullable()->after('skill_distribution_1');
            $table->string('skill_distribution_3')->nullable()->after('skill_distribution_2');
            $table->string('skill_comment_1', 100)->nullable()->after('skill_distribution_3');
            $table->string('skill_comment_2', 100)->nullable()->after('skill_comment_1');
            $table->string('skill_comment_3', 100)->nullable()->after('skill_comment_2');
            $table->json('work_preference')->nullable()->after('num_companies_worked');
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->dropColumn('skill_distribution_1');
            $table->dropColumn('skill_distribution_2');
            $table->dropColumn('skill_distribution_3');
            $table->dropColumn('skill_comment_1');
            $table->dropColumn('skill_comment_2');
            $table->dropColumn('skill_comment_3');
            $table->dropColumn('work_preference');
        });
    }
}
