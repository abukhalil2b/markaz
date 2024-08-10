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
        Schema::create('duaacate_student_task', function (Blueprint $table) {
            $table->id();
            $table->integer('duaacate_student_id');
            $table->integer('duaacate_task_id');
            $table->boolean('numwrong')->default(0);
            $table->string('evaluation',20);
            $table->string('evaluatedby_name',50)->nullable();
            $table->date('done_at')->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duaacate_student_task');
    }
};
