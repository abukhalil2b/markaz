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
        Schema::create('subscriptionfees', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount',6,3)->default(0.000);
            $table->integer('student_id');
            $table->string('note')->nullable();
            $table->integer('semester_id')->unsigned();
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
        Schema::dropIfExists('subscriptionfees');
    }
};
