<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryNodesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gallery_nodes', function (Blueprint $table)
		{
			$table->unsignedInteger('gallery_id');
			$table->char('language_id', 2);
			$table->string('title');
			$table->string('slug', 60);
			$table->text('description')->nullable();

			$table->primary(['gallery_id', 'language_id']);
			$table->unique(['slug', 'language_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gallery_nodes');
	}

}
