<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('subscription_id');
			$table->char('language_id', 2);
			$table->string('title');
			$table->text('description')->nullable();
			$table->timestamps();

			$table->primary(['subscription_id', 'language_id']);
			$table->unique(['subscription_id', 'language_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscription_nodes');
	}

}
