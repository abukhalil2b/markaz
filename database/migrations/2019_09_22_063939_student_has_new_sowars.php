<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudentHasNewSowars extends Migration {
	/**StudentHasNewSowars
		     * Run the migrations.
		     *
		     * @return void
	*/
	public function up() {
		Schema::create('student_has_new_sowars', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('student_id');
			$table->integer('sowar_id');
			$table->integer('mission_id');
			$table->string('mission_title')->nullable();
			$table->string('ayat');
			$table->string('done_at')->nullable();
			$table->boolean('done')->default(0);
			$table->boolean('selected_as_multisora')->default(0);
			$table->boolean('selected_as_onesora')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('student_has_new_sowars');
	}
}
