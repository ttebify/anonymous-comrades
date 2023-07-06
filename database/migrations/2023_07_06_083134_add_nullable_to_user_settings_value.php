<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToUserSettingsValue extends Migration
{
    public function up()
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->json('value')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->json('value')->change();
        });
    }
}
