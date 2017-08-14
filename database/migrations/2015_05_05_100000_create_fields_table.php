<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fields', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('fieldable_type');
			$table->unsignedInteger('fieldable_id')->nullable();
			$table->string('slug');
			$table->string('type');
			$table->string('validation');
			$table->mediumText('title');
			$table->mediumText('options')->nullable();
			$table->timestamps();

			$table->unique(['fieldable_type', 'fieldable_id', 'slug']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fields');
	}

}
