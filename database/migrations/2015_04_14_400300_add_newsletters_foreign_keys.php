<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewslettersForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('newsletters', function(Blueprint $table)
		{
			$table->foreign('subscription_id')
				->references('id')
				->on('subscriptions')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('newsletters', function(Blueprint $table)
		{
			$table->dropForeign('newsletters_subscription_id_foreign');
		});
	}

}
