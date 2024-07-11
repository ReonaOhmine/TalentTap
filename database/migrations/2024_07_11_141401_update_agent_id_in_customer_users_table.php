<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAgentIdInCustomerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->default(1)->change();
        });
    }

    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->unsignedBigInteger('agent_id')->nullable(false)->change();
        });
    }
}
