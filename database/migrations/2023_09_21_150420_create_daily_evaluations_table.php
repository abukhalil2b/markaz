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
        Schema::create('daily_evaluations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id');
            $table->bigInteger('level_id');
            $table->string('descr',100);//descr
            $table->string('full_name',50);//full_name
            $table->string('evaluation',20);// super_excellent - excellent - very_good - good - did_not_succeed
            $table->string('model_type',30);// table name
            $table->bigInteger('model_id');//  table id
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
        Schema::dropIfExists('daily_evaluations');
    }
};
