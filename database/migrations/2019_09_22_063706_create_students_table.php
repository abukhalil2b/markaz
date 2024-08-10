<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('students', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('national_id');
			$table->string('first_name')->nullable();
			$table->string('user_type',20)->default('student');
			$table->string('second_name')->nullable();
			$table->string('third_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('full_name')->nullable();
			$table->char('gender')->nullable();
			$table->smallInteger('level_id')->default(1);
			$table->string('status',15)->default('waitingApproval');
			$table->string('note')->nullable();
			$table->timestamps();
			$table->string('password')->nullable();
			$table->boolean('todayserving')->default(0);
			$table->integer('workperiod_id')->default(1);
			$table->text('study_days')->nullable();
			$table->boolean('under_observation')->default(0);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('students');
	}
}
