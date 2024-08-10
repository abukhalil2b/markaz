<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlysubscribeStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthlysubscribe_students', function (Blueprint $table) {
            $table->id();
            $table->integer('recordmonthly_id');
            $table->integer('student_id');
            $table->char('gender');
            $table->integer('amount');
            $table->boolean('paid')->default(0);
            $table->date('paid_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthlysubscribe_students');
    }
}
