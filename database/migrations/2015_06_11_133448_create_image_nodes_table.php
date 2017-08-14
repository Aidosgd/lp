<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_nodes', function(Blueprint $table)
		{
			$table->unsignedBigInteger('image_id');
			$table->string('language_id', 2);
			$table->string('title', 255);
			$table->text('description')->nullable();

			$table->primary(['language_id','image_id']);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('image_nodes');
	}

}
