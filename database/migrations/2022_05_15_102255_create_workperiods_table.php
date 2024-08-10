<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkperiodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workperiods', function (Blueprint $table) {
            $table->id();
            $table->char('gender',1)->default('m');
            $table->string('title')->default('الفترة المسائية');
            $table->time('student_award_time');
            $table->time('moderator_should_be_present_at');
            $table->time('teacher_should_be_present_at');
            $table->time('student_should_be_present_at');
        });

        Schema::create('user_has_workperiod', function (Blueprint $table) {
            $table->id();
            $table->integer('workperiod_id');
            $table->integer('user_id');
        });

        Schema::create('level_has_workperiod', function (Blueprint $table) {
            $table->id();
            $table->integer('workperiod_id');
            $table->integer('level_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workperiods');
    }
}
