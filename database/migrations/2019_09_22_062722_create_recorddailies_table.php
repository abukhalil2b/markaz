<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecorddailiesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('recorddailies', function (Blueprint $table) {
			$table->increments('id');
			$table->string('day',5);
			$table->string('title');
			$table->timestamps();
			$table->tinyInteger('workperiod_id')->default(1);
			$table->string('gender')->default('m');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('recorddailies');
	}
}
