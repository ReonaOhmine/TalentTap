<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgentIdToCustomerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            // カラムが存在しない場合のみ追加
            if (!Schema::hasColumn('customer_users', 'agent_id')) {
                $table->unsignedBigInteger('agent_id')->nullable()->after('id');
            }

            // 外部キー制約を追加
            $table->foreign('agent_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['agent_id']);

            // カラムを削除
            $table->dropColumn('agent_id');
        });
    }
}
