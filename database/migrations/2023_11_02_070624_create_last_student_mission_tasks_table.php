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
        Schema::create('last_student_mission_tasks', function (Blueprint $table) {
            $table->id();

            $table->integer('workperiod_id');

            $table->integer('level_id');

            $table->integer('student_id');

            $table->integer('student_mission_task_id');

            $table->string('student_name',50);

            $table->string('descr',100);

            $table->string('evaluation',10);
            
            $table->string('evaluatedby_name',50)->nullable();
            
            $table->boolean('point')->default(0);
            
            $table->text('wrongs')->nullable();
            
            $table->text('note')->nullable();

            $table->timestamp('done_at')->nullable();
            
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
        Schema::dropIfExists('last_student_mission_tasks');
    }
};
