<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentHasDuaasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_has_duaas', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('duaa_id');
            $table->timestamp('start_at');
            $table->timestamp('tobedone_at')->nullable();
            $table->timestamp('done_at')->nullable();
            $table->boolean('success')->nullable();
            $table->smallInteger('numwrong')->nullable();
            $table->string('evaluation')->nullable();
            $table->text('notes')->nullable();
            $table->string('timing_status',10)->nullable();//null,late, forgiven, onTime
            $table->boolean('ignore_timing')->default(1);
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
        Schema::dropIfExists('student_has_duaas');
    }
}
