<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserHasPermissionTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('roles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
		});
		Schema::create('permissions', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug');
			$table->string('cate');
			$table->string('description')->nullable();
		});
		Schema::create('user_has_permissions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('permission_id');
		});
		Schema::create('role_has_permissions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('role_id');
			$table->integer('permission_id');
		});
		Schema::create('user_has_roles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('role_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('user_has_permissions');
	}
}
