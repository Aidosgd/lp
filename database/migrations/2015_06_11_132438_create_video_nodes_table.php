<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('video_id');
			$table->string('language_id', 2);
			$table->string('title', 255);
			$table->string('description', 255)->nullable();
			$table->boolean('is_published');

			$table->primary(['language_id','video_id']);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('video_nodes');
	}

}
