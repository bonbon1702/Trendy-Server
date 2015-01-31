<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUploadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('upload', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('name')->nullable()->default('0000-00-00 00:00:00');
			$table->string('image_url')->nullable();
			$table->string('image_url_editor')->nullable();
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
		Schema::drop('upload');
	}

}
