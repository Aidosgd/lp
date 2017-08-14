<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('term_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('term_id');
			$table->char('language_id', 2);
			$table->string('title');
			$table->string('slug');
			$table->text('description')->nullable();
			$table->timestamps();

			$table->primary(['term_id', 'language_id']);
			$table->unique(['language_id', 'slug']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('term_nodes');
	}

}
