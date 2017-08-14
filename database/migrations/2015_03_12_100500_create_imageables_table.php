<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imageables', function(Blueprint $table)
		{
			$table->unsignedBigInteger('image_id');
			$table->morphs('imageable');
			$table->string('title')->nullable();
			$table->string('alt')->nullable();
			$table->string('cropped_coords')->nullable();
			$table->integer('sort_order')->nullable();
			$table->primary(['image_id', 'imageable_id', 'imageable_type']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imageables');
	}

}
