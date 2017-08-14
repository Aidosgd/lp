<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryVideoPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_video', function(Blueprint $table)
		{
			$table->unsignedInteger('gallery_id');
			$table->unsignedInteger('video_id');
			$table->smallInteger('weight')->default(0);

			$table->primary(['gallery_id', 'video_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gallery_video');
	}

}
