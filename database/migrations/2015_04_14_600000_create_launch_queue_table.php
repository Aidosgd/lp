<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaunchQueueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('launch_queue', function(Blueprint $table)
		{
			$table->unsignedInteger('newsletter_launch_id');
			$table->unsignedInteger('subscriber_id');
			$table->unsignedInteger('status',0);
			$table->timestamps();

			$table->primary(['newsletter_launch_id', 'subscriber_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('launch_queue');
	}

}
