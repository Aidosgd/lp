<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesPublishedField extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('category_nodes', function(Blueprint $table)
		{
			$table->boolean('published')->default(true)->after('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('category_nodes', function(Blueprint $table)
		{
			$table->dropColumn('published');
		});
	}

}
