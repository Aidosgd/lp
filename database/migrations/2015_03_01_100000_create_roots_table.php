<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roots', function(Blueprint $table)
		{
			$table->unsignedInteger('id')->unique();
			$table->string('slug', 60);
			$table->mediumText('title');
			$table->mediumText('config')->nullable();
			$table->softDeletes();
			$table->timestamps();

			$table->primary('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roots');
	}

}
