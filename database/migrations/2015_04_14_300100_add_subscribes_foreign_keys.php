<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscribesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscribes', function(Blueprint $table)
		{
			$table->foreign('subscription_id')
				->references('id')
				->on('subscriptions')
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
		Schema::table('subscribes', function(Blueprint $table)
		{
			$table->dropForeign('subscribes_subscription_id_foreign');
			$table->dropForeign('subscribes_subscriber_id_foreign');
		});
	}

}
