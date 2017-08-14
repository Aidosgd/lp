<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLaunchQueueForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('launch_queue', function(Blueprint $table)
		{
			$table->foreign('newsletter_launch_id')
				->references('id')
				->on('newsletter_launches')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');

			$table->foreign('subscriber_id')
				->references('id')
				->on('subscribers')
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
		Schema::table('launch_queue', function(Blueprint $table)
		{
			$table->dropForeign('launch_queue_newsletter_launch_id_foreign');
			$table->dropForeign('launch_queue_subscriber_id_foreign');
		});
	}

}
