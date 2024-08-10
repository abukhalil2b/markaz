<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('missions', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('note');
			$table->string('startfrom');
			$table->string('endto');
			$table->string('track_type')->default('review');
			$table->string('track_type')->default('thomon');
			$table->string('allowed_wrong_number',1)->default(2);
			$table->string('status',20)->default('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('missions');
	}
}
