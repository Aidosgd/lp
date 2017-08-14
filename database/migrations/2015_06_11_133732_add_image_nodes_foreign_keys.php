<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNodesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image_nodes', function(Blueprint $table)
		{
			$table->foreign('image_id')
				->references('id')
				->on('images')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image_nodes', function(Blueprint $table)
		{
			$table->dropForeign('image_nodes_image_id_foreign');
		});
	}

}
