<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicChatsTable extends Migration
{
    public function up()
    {
        Schema::create('public_chats', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->text('content');
            $table->boolean('hidden')->default(true);
            $table->ulid('created_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('public_chats');
    }
}
