<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveTypeFromFavoriteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('favorite', function(Blueprint $table)
		{
			$table->dropColumn('type_favorite');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('favorite', function(Blueprint $table)
		{
			
		});
	}

}
