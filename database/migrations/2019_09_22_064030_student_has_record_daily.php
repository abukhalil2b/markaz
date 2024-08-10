<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentHasRecordDaily extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('student_has_record_daily', function (Blueprint $table) {
			$table->increments('id');
			$table->string('year');
			$table->string('month');
			$table->integer('recorddaily_id');
			$table->integer('student_id');
			$table->char('gender', 1)->default('m');
			$table->integer('level_id')->default(0);
			$table->string('present_time')->nullable();
			$table->boolean('with_excuse')->default(0);
			$table->string('note')->nullable();
			$table->boolean('islate')->default(0);
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('student_has_record_daily');
	}
}
