<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_detail', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('shop_id')->nullable();
			$table->string('name')->nullable();
			$table->string('street')->nullable();
			$table->string('district')->nullable();
			$table->string('city')->nullable();
			$table->string('near_place')->nullable();
			$table->string('way_direction')->nullable();
			$table->string('lat', 45)->nullable();
			$table->string('long', 45)->nullable();
			$table->string('time_open', 45)->nullable();
			$table->string('time_close', 45)->nullable();
			$table->string('price_from', 45)->nullable();
			$table->string('price_to', 45)->nullable();
			$table->integer('morning')->nullable();
			$table->integer('midday')->nullable();
			$table->integer('afternoon')->nullable();
			$table->integer('night')->nullable();
			$table->integer('shipping')->nullable();
			$table->integer('credit_card')->nullable();
			$table->integer('cooler')->nullable();
			$table->integer('parking')->nullable();
			$table->integer('children')->nullable();
			$table->integer('teen')->nullable();
			$table->integer('middleaged')->nullable();
			$table->integer('oldster')->nullable();
			$table->integer('men')->nullable();
			$table->integer('women')->nullable();
			$table->string('tel', 45)->nullable();
			$table->string('website', 45)->nullable();
			$table->string('facebook_page', 45)->nullable();
			$table->integer('approve')->nullable();
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
		Schema::drop('shop_detail');
	}

}
