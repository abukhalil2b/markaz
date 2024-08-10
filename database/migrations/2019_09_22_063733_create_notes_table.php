<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('notes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('action')->nullable();
			$table->integer('student_id');
			$table->integer('level_id');
			$table->integer('user_id');
			$table->string('gender');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('notes');
	}
}
