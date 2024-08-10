<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration {

	public function up() {
		Schema::create('marks', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('student_id');
			$table->string('tag');
			$table->string('note')->nullable();
			$table->string('point');
			$table->integer('student_mission_task_id')->nullable();
			$table->integer('duaacate_student_task_id')->nullable();
			$table->timestamps();
		});
	}
	
	public function down() {
		Schema::dropIfExists('marks');
	}
}
