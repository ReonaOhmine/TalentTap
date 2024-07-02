<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHpUrlAndLogoImageToEmployerUsersTable extends Migration
{
    public function up()
    {
        Schema::table('employer_users', function (Blueprint $table) {
            $table->string('hp_url')->nullable()->after('tel');
            $table->string('logo_image')->nullable()->after('hp_url');
        });
    }

    public function down()
    {
        Schema::table('employer_users', function (Blueprint $table) {
            $table->dropColumn('hp_url');
            $table->dropColumn('logo_image');
        });
    }
}
