<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageablesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imageables', function(Blueprint $table)
		{
			$table->foreign('image_id')
				->references('id')
				->on('images')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imageables', function(Blueprint $table)
		{
			$table->dropForeign('imageables_image_id_foreign');
		});
	}

}