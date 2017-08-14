<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fileables', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('file_id');
			$table->morphs('fileable');
			$table->string('title')->nullable();
			$table->string('field_slug')->nullable();
			$table->unique(['file_id', 'fileable_id', 'fileable_type', 'field_slug']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fileables');
	}

}
