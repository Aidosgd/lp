<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_agents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('agent');
		});

		Schema::create('hosts', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedInteger('user_id')->nullable();
			$table->unsignedInteger('user_agent_id');
			$table->unsignedInteger('ip');

			// Partitial SHA-1 hash of user_id, user_agent_id and ip
			// which remains unique if user is deleted
			$table->char('hash', 8);
			$table->unique('hash');

			$table->index('ip');

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('CASCADE')
				->onDelete('SET NULL');

			$table->foreign('user_agent_id')
				->references('id')
				->on('user_agents')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');
		});

		Schema::create('moderations', function(Blueprint $table)
		{
			$table->morphs('moderateable');
			$table->tinyInteger('status', false, true)->default(0);
			$table->unsignedInteger('user_id')->nullable();
			$table->timestamps();

			$table->unique(['moderateable_id', 'moderateable_type']);

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});

		Schema::create('hits', function(Blueprint $table)
		{
			$table->unsignedBigInteger('host_id');
			$table->char('language_id', 2);
			$table->morphs('hitable');
			$table->string('hostname');
			$table->string('path')->nullable();
			$table->string('query')->nullable();
			$table->timestamps();

			$table->index('language_id');

			$table->foreign('host_id')
				->references('id')
				->on('hosts')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});

		Schema::create('comments', function(Blueprint $table)
		{
			$table->bigIncrements('id');

			$table->unsignedBigInteger('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

			$table->char('language_id', 2);

			$table->morphs('commentable');

			$table->unsignedInteger('user_id')->nullable();
			$table->unsignedBigInteger('host_id')->nullable();
			$table->mediumText('user_data')->nullable();

			$table->string('subject')->nullable();
			$table->text('content');

			$table->tinyInteger('status')->default(0);

			$table->timestamps();

			$table->foreign('parent_id')
				->references('id')
				->on('comments')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');

			$table->foreign('host_id')
				->references('id')
				->on('hosts')
				->onUpdate('CASCADE')
				->onDelete('SET NULL');
		});

		Schema::create('likes', function(Blueprint $table)
		{
			// ID is only for eager loading
			$table->bigIncrements('id');
			$table->morphs('likeable');
			$table->unsignedInteger('user_id');
			$table->unsignedBigInteger('comment_id')->nullable();
			$table->char('language_id', 2);
			$table->timestamps();

			$table->index('user_id');
			$table->index('language_id');
			$table->unique(['user_id', 'likeable_id', 'likeable_type']);

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');

			$table->foreign('comment_id')
				->references('id')
				->on('comments')
				->onUpdate('CASCADE')
				->onDelete('SET NULL');
		});

		Schema::create('rates', function(Blueprint $table)
		{
			// ID is only for eager loading
			$table->bigIncrements('id');
			$table->morphs('rateable');
			$table->unsignedInteger('user_id');
			$table->unsignedBigInteger('comment_id')->nullable();
			$table->char('language_id', 2);
			$table->tinyInteger('points')->unsigned()->default(0);
			$table->timestamps();

			$table->index('user_id');
			$table->index('language_id');
			$table->unique(['user_id', 'rateable_id', 'rateable_type']);

			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');

			$table->foreign('comment_id')
				->references('id')
				->on('comments')
				->onUpdate('CASCADE')
				->onDelete('SET NULL');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rates', function(Blueprint $table)
		{
			$table->dropForeign('rates_user_id_foreign');
			$table->dropForeign('rates_comment_id_foreign');
		});
		Schema::drop('rates');

		Schema::table('likes', function(Blueprint $table)
		{
			$table->dropForeign('likes_user_id_foreign');
			$table->dropForeign('likes_comment_id_foreign');
		});
		Schema::drop('likes');

		Schema::table('comments', function(Blueprint $table)
		{
			$table->dropForeign('comments_parent_id_foreign');
			$table->dropForeign('comments_user_id_foreign');
		});
		Schema::drop('comments');

		Schema::table('hits', function(Blueprint $table)
		{
			$table->dropForeign('hits_host_id_foreign');
		});
		Schema::drop('hits');

		Schema::table('moderations', function(Blueprint $table)
		{
			$table->dropForeign('moderations_user_id_foreign');
		});
		Schema::drop('moderations');

		Schema::table('hosts', function(Blueprint $table)
		{
			$table->dropForeign('hosts_user_id_foreign');
			$table->dropForeign('hosts_user_agent_id_foreign');
		});
		Schema::drop('hosts');

		Schema::drop('user_agents');
	}

}
