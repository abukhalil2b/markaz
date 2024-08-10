<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->integer('user_id');
            $table->integer('suggestioncate_id')->nullable();
            $table->boolean('replay')->default(0);
            $table->integer('parent')->nullable();
            $table->timestamps();
        });

        Schema::create('suggestionpermissions', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('suggestioncate_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggestions');
        Schema::dropIfExists('suggestionpermissions');
    }
}
