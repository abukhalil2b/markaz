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
        Schema::create('mission_tasks', function (Blueprint $table) {
            $table->id();

            $table->smallInteger('task_order')
                ->unsigned();

            $table->string('descr')->nullable();

            $table->string('select_type', 15)->default('oneSurat'); // oneSurat - suratToSurat - ayaToAya - page - pageToPage

            $table->tinyInteger('hesas_mission_id')
            ->comment('عندما يعطى الطالب مهمة الحصص')
            ->nullable()
            ->unsigned();

            $table->string('mission_type', 10)->default('new'); // new - review
            
            $table->integer('mission_id')->unsigned();

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

            $table->smallInteger('from_page_number')
                ->nullable()
                ->unsigned();

            $table->smallInteger('to_page_number')
                ->nullable()
                ->unsigned();

            $table->smallInteger('page_number')
                ->nullable()
                ->unsigned();

            $table->smallInteger('surat_id')
                ->nullable()
                ->unsigned();

            $table->boolean('allow_wrong')->default(1);

            // constrain
            $table->foreign('mission_id')->references('id')->on('missions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_tasks');
    }
};
