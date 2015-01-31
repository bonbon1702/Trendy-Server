<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagPictureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_picture', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('post_id')->nullable();
			$table->integer('shop_id')->nullable();
			$table->string('name')->nullable();
			$table->string('price')->nullable();
			$table->integer('top')->nullable();
			$table->integer('left')->nullable();
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
		Schema::drop('tag_picture');
	}

}
