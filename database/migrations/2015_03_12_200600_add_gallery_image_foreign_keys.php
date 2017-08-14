<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryImageForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery_image', function(Blueprint $table)
		{
			$table->foreign('image_id')
				  ->references('id')
				  ->on('images')
				  ->onUpdate('CASCADE')
				  ->onDelete('CASCADE');

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
		Schema::table('gallery_image', function(Blueprint $table)
		{
			$table->dropForeign('gallery_image_image_id_foreign');
			$table->dropForeign('gallery_image_gallery_id_foreign');
		});
	}

}
