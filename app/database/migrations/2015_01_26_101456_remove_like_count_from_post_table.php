<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveLikeCountFromPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post', function(Blueprint $table)
		{
			$table->dropColumn('liked_count');
			$table->dropColumn('liked_count_month');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post', function(Blueprint $table)
		{
			
		});
	}

}
