<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function (Blueprint $table)
		{
			$table->bigIncrements('id')->unsigned();
			$table->unsignedInteger('user_id')->index()->nullable();
			$table->string('name', 16);
			$table->text('description')->nullable();
			$table->string('mime', 32);
			$table->string('path');
			$table->mediumText('meta')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}