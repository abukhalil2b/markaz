<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSowarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sowars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('ayat');
            $table->string('thomon_num');
            $table->string('allowed_wrong_number',1)->default(2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sowars');
    }
}
