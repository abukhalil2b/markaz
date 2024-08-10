<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestleavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestleaves', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('datefrom');
            $table->date('dateto');
            $table->string('status')->default('new');
            $table->integer('user_id');
            $table->char('gender',1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requestleaves');
    }
}
