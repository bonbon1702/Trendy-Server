<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sw_id')->nullable();
			$table->string('email')->nullable();
			$table->string('username')->nullable();
			$table->string('picture_profile')->nullable();
			$table->string('remember_token')->nullable();
			$table->string('image_cover')->nullable();
			$table->integer('gender')->nullable();
			$table->integer('delete_flag')->nullable();
			$table->timestamps();
			$table->integer('role_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
