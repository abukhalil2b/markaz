<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRecorddailiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_recorddailies', function (Blueprint $table) {
            $table->id();
            $table->integer('recorddaily_id');
            $table->integer('user_id');
            $table->string('gender');
            $table->boolean('islate')->default(0);
            $table->tinyText('note');
            $table->boolean('notification_is_seen')->default(0);
            $table->time('should_be_present_at');
            $table->time('present_time')->nullable();
            $table->tinyText('moderator_note')->nullable();
            $table->boolean('moderator_seen')->default(0);
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
        Schema::dropIfExists('user_recorddailies');
    }
}


/*

'recorddaily_id',
    'user_id',
    'gender',
    'present_time',
    'islate',
    'note',
    'notification_is_seen',
    'time_should_be_present'
*/