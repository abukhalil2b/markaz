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
        Schema::create('semester_student_amount_to_pay', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',6,3)->default(0.000);
            $table->integer('student_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('workperiod_id')->unsigned();
            $table->boolean('isforgiven')->default(false);
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
        Schema::dropIfExists('semester_student_amount_to_pay');
    }
};
