<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentHasMission extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('student_has_mission', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('student_id');
			$table->integer('mission_id');
			$table->string('mission_title')->nullable();
			$table->string('start_at');
			$table->timestamp('started_at');
			$table->string('tobedone_at')->nullable();
			$table->string('done_at')->nullable();
			$table->boolean('done')->default(0);
			$table->string('mission_description')->nullable();
			$table->string('type')->nullable();
			$table->string('track_type',12)->default('review');
			$table->string('track_cate')->default('thomon');
			$table->boolean('success')->nullable();
			$table->boolean('try_number')->default(0)
			->comment('يسمح فقط ثلاث محاولات لإعادة المهمة');
			$table->smallInteger('numwrong')->nullable();
			$table->string('wrongs')->nullable();
			$table->tinyInteger('attention_number')->default(0);
			$table->tinyInteger('stop_number')->default(0);
			$table->string('evaluation')->nullable();
			$table->integer('evaluatedby_id')->nullable();
			$table->text('notes')->nullable();
			$table->boolean('step_approval')->default(0)->comment('0=teacher. 1=moderator. 2=admin.');// 
			$table->string('timing_status',10)->nullable();//null,late, forgiven, onTime
			$table->boolean('ignore_timing')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('student_has_mission');
	}
}
