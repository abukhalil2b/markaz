<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // user cannot send a message to any user.
        Schema::create('message_receiver_permissions', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('receiver_id')->unsigned();

            // constrain
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receiver_id')->references('id')->on('users');
        });

        Schema::create('message_receiver', function (Blueprint $table) {
            $table->bigInteger('message_id')->unsigned();
            $table->integer('receiver_id')->unsigned();//user_id
            $table->boolean('is_read')->default(0);

            // constrain
            $table->foreign('message_id')->references('id')->on('messages');
            $table->foreign('receiver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_receiver_permissions');
    }
};
