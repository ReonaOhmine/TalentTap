<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdayToCustomerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->date('birthday')->nullable()->after('created_at');
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->dropColumn('birthday');
        });
    }
}
