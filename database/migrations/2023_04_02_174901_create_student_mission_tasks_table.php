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
        Schema::create('student_mission_tasks', function (Blueprint $table) {
            $table->id();

            $table->integer('mission_task_id')->unsigned();

            $table->smallInteger('task_order')
                ->unsigned()
                ->default(1);

            $table->string('descr')->nullable();

            $table->string('select_type', 15)->default('oneSurat'); // oneSurat - suratToSurat - ayaToAya - page

            $table->tinyInteger('hesas_mission_id')
            ->comment('عندما يعطى الطالب مهمة الحصص')
            ->nullable()
            ->unsigned();

            $table->string('mission_type', 10)->default('new'); // new - review
            
            $table->bigInteger('student_mission_id')->unsigned();

            $table->smallInteger('from_aya_id')
                ->nullable()
                ->unsigned();

            $table->smallInteger('to_aya_id')
                ->nullable()
                ->unsigned();

            $table->smallInteger('from_surat_id')
                ->nullable()
                ->unsigned();

            $table->smallInteger('to_surat_id')
                ->nullable()
                ->unsigned();

            $table->smallInteger('page_number')
                ->nullable()
                ->unsigned();

            $table->smallInteger('surat_id')
                ->nullable()
                ->unsigned();

            $table->boolean('allow_wrong')->default(1);

            $table->integer('student_id')->unsigned();

            $table->date('done_at')->nullable();
            
            $table->string('evaluation')->nullable();
            
            $table->string('evaluatedby_name',50)->nullable();
            
            $table->text('note')->nullable();
            
            $table->string('pass_reading', 20)->nullable();
            
            $table->string('wrongs')->nullable();
            
            $table->date('half_done_at')->nullable();
             // we set this to date which student did half mission

            
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_mission_tasks');
    }
};
