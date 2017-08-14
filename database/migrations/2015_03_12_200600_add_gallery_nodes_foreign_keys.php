<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryNodesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery_nodes', function(Blueprint $table)
		{
			$table->foreign('gallery_id')
				->references('id')
				->on('galleries')
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
		Schema::table('gallery_nodes', function(Blueprint $table)
		{
			$table->dropForeign('gallery_nodes_gallery_id_foreign');
		});
	}

}