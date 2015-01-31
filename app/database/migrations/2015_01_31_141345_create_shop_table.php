<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('image_url')->nullable();
			$table->string('image_url_resize')->nullable();
			$table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->string('lat')->nullable();
			$table->string('long')->nullable();
			$table->string('address')->nullable();
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
		Schema::drop('shop');
	}

}
