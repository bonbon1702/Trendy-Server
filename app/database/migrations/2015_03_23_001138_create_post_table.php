<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable()->default('0');
			$table->integer('user_id')->nullable();
			$table->string('image_url')->nullable();
			$table->string('image_url_editor')->nullable();
			$table->string('caption')->nullable();
			$table->integer('day')->nullable()->default(0);
			$table->integer('interaction')->nullable()->default(0);
			$table->integer('sqr_interaction')->nullable()->default(0);
			$table->float('zScore', 10, 0)->nullable()->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post');
	}

}
