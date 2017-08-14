<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedback_group', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
		});

		Schema::create('feedback_group_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('feedback_group_id');
			$table->char('language_id', 2);
			$table->string('title');
			$table->string('slug', 60);
			$table->text('description')->nullable();
			$table->string('emails')->nullable();
			$table->timestamps();

			$table->primary(['feedback_group_id', 'language_id']);

			$table->foreign('feedback_group_id')
				->references('id')
				->on('feedback_group')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});

		Schema::create('feedback', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('language_id', 2);
			$table->unsignedInteger('user_id')->nullable();
			$table->unsignedInteger('host_id')->nullable();
			$table->unsignedInteger('feedback_group_id')->nullable();
			$table->mediumText('content')->nullable();
			$table->timestamps();

			$table->foreign('feedback_group_id')
				->references('id')
				->on('feedback_group')
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
		Schema::table('feedback', function(Blueprint $table)
		{
			$table->dropForeign('feedback_feedback_group_id_foreign');
		});
		Schema::drop('feedback');

		Schema::table('feedback_group_nodes', function(Blueprint $table)
		{
			$table->dropForeign('feedback_group_nodes_feedback_group_id_foreign');
		});
		Schema::drop('feedback_group_nodes');

		Schema::drop('feedback_group');
	}

}
