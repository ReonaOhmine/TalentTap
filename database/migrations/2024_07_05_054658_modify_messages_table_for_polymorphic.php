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
            $table->string('sender_type'); // ポリモーフィックリレーションのためのカラム
            $table->string('receiver_type'); // ポリモーフィックリレーションのためのカラム

            // 既存の外部キー制約を削除（ポリモーフィックリレーションのため）
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // 外部キー制約を再追加
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

            $table->dropColumn('sender_type');
            $table->dropColumn('receiver_type');
        });
    }
};
