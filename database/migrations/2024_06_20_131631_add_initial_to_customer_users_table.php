<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialToCustomerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->string('initial')->nullable(); // イニシャル
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->dropColumn('initial');
        });
    }
}
