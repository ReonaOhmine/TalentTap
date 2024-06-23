<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecommendationToCustomerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->text('recommendation')->nullable(); // こんな企業におすすめ
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->dropColumn('recommendation');
        });
    }
}
