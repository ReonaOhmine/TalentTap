<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('tel')->nullable();
            $table->timestamp('email_verified_at')->nullable(); // メール検証日時
            $table->string('password');
            $table->rememberToken(); // ログイン状態の保持トークン
            $table->timestamps(); // 作成日時と更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
