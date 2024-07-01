<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderColumnToCustomerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->string('gender')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            // 必要に応じて、元の状態に戻す処理をここに記述
        });
    }
}
