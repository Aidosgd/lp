<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionNodesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscription_nodes', function(Blueprint $table)
		{
			$table->foreign('subscription_id')
				->references('id')
				->on('subscriptions')
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
		Schema::table('subscription_nodes', function(Blueprint $table)
		{
			$table->dropForeign('subscription_nodes_subscription_id_foreign');
		});
	}

}
