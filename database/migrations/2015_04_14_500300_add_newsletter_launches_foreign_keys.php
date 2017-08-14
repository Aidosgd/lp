<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewsletterLaunchesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('newsletter_launches', function(Blueprint $table)
		{
			$table->foreign('newsletter_id')
				->references('id')
				->on('newsletters')
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
		Schema::table('newsletter_launches', function(Blueprint $table)
		{
			$table->dropForeign('newsletter_launches_newsletter_id_foreign');
		});
	}

}
