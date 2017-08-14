<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoNodesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('video_nodes', function(Blueprint $table)
		{
			$table->foreign('video_id')
				->references('id')
				->on('videos')
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
		Schema::table('video_nodes', function(Blueprint $table)
		{
			$table->dropForeign('video_nodes_video_id_foreign');
		});
	}

}
