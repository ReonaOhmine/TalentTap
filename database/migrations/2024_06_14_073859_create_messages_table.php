<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id'); // 送信者ID
            $table->unsignedBigInteger('to_user_id'); // 受信者ID
            $table->text('message'); // メッセージ内容
            $table->timestamps();

            $table->foreign('from_user_id')->references('id')->on('employer_users')->onDelete('cascade');
            $table->foreign('to_user_id')->references('id')->on('agents')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
