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
        Schema::create('student_missions', function (Blueprint $table) {
            $table->id();
			$table->integer('student_id');
			$table->integer('mission_id');
            $table->timestamp('start_at')->useCurrent();
			$table->date('tobedone_at')->nullable();
			$table->date('done_at')->nullable();
			$table->string('cate')->nullable();
			$table->boolean('success')->nullable();
			$table->smallInteger('numwrong')->nullable();
			$table->string('wrongs')->nullable();
			$table->string('evaluation')->nullable();
			$table->text('note')->nullable();
			$table->string('timing_status',10)->nullable();//null,late, forgiven, onTime
			$table->string('approve_status')->default('approve');
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
        Schema::dropIfExists('student_missions');
    }
};
