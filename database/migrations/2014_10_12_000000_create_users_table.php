<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * admin moderators teachers
	 */
	
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('national_id',10)->nullable();
			$table->string('first_name',50);
			$table->string('second_name',50)->nullable();
			$table->string('third_name',50)->nullable();
			$table->string('last_name',50)->nullable();
			$table->string('full_name',50)->nullable();

			$table->string('gender',10)->nullable();
			$table->string('phone',10)->nullable();

			$table->string('user_type',20)->default('teacher');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->string('plain_password',20);

			$table->smallInteger('level_id')->default(1);
			$table->boolean('active')->default(1);
			$table->text('note')->nullable();
			$table->integer('workperiod_id')->default(1);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('users');
	}
}
