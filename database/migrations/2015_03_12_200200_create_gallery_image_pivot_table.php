<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryImagePivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_image', function(Blueprint $table)
		{
			$table->unsignedInteger('gallery_id');
			$table->unsignedBigInteger('image_id');
			$table->smallInteger('weight')->default(0);

			$table->primary(['gallery_id', 'image_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gallery_image');
	}

}
