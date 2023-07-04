<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicChatsTable extends Migration
{
    public function up()
    {
        Schema::create('public_chats', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->text('content');
            $table->boolean('hidden')->default(true);
            $table->unsignedBigInteger('createdBy');
            $table->timestamps();

            $table->foreign('createdBy')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('public_chats');
    }
}
