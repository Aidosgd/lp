<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryVideoForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gallery_video', function(Blueprint $table)
		{
			$table->foreign('video_id')
				->references('id')
				->on('videos')
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
		Schema::table('gallery_video', function(Blueprint $table)
		{
			$table->dropForeign('gallery_video_video_id_foreign');
			$table->dropForeign('gallery_video_gallery_id_foreign');
		});
	}

}
