<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // 既存のカラムなので追加は不要
            // $table->string('sender_type')->nullable();
            // $table->string('receiver_type')->nullable();

            // 外部キー制約を再追加
            $table->foreign('sender_id')->references('id')->on('agents')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('employer_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // 追加した外部キー制約を削除
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);

            // カラムの削除も不要
            // $table->dropColumn('sender_type');
            // $table->dropColumn('receiver_type');
        });
    }
};
