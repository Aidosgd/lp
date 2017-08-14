<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionQueueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_queue', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('post_id');
			$table->boolean('sended')->default(false);
			$table->boolean('queued')->default(false);
			$table->timestamps();

			$table->foreign('post_id')->references('id')->on('posts')
				->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscription_queue');
	}

}
