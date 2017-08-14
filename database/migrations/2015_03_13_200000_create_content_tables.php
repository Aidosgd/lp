<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('parent_id')->nullable()->index();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();

			$table->unsignedBigInteger('image_id')->nullable()->index();

			$table->timestamps();

			$table->foreign('parent_id')
				->references('id')
				->on('categories')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});

		Schema::create('category_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('category_id');
			$table->char('language_id', 2);
			$table->string('title');
			$table->string('slug', 60);
			$table->text('description')->nullable();
			$table->string('seo_description', 255)->nullable();
			$table->string('seo_title', 255)->nullable();
			$table->string('seo_keywords', 255)->nullable();
			$table->timestamps();

			$table->primary(['category_id', 'language_id']);
			$table->unique(['slug', 'language_id']);

			$table->foreign('category_id')
				->references('id')
				->on('categories')
				->onUpdate('CASCADE')
				->onDelete('CASCADE');
		});

		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('category_id')->nullable();
			$table->unsignedInteger('root_id');
			$table->mediumText('meta')->nullable();
			$table->tinyInteger('newsletter_enabled')->nullable();
			$table->dateTime('publish_from')->nullable();
			$table->dateTime('publish_till')->nullable();
			$table->softDeletes();
			$table->dateTime('display_date')->nullable();
			$table->timestamps();

			$table->foreign('user_id')
				->references('id')
				->on('admins')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');

			$table->foreign('category_id')
				->references('id')
				->on('categories')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');

			$table->foreign('root_id')
				->references('id')
				->on('roots')
				->onUpdate('CASCADE')
				->onDelete('RESTRICT');

		});

		Schema::create('post_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('post_id');
			$table->char('language_id', 2);
			$table->string('title');
			$table->string('slug', 60);
			$table->text('teaser')->nullable();
			$table->longText('content')->nullable();
			$table->mediumText('fields')->nullable();
			$table->string('seo_description', 255)->nullable();
			$table->string('seo_title', 255)->nullable();
			$table->string('seo_keywords', 255)->nullable();
			$table->timestamps();

			$table->primary(['post_id', 'language_id']);
			$table->unique(['slug', 'language_id']);

			$table->foreign('post_id')
				->references('id')
				->on('posts')
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
		Schema::table('post_nodes', function(Blueprint $table)
		{
			$table->dropForeign('post_nodes_post_id_foreign');
		});
		Schema::drop('post_nodes');

		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropForeign('posts_user_id_foreign');
			$table->dropForeign('posts_category_id_foreign');
			$table->dropForeign('posts_root_id_foreign');
		});
		Schema::drop('posts');

		Schema::table('category_nodes', function(Blueprint $table)
		{
			$table->dropForeign('category_nodes_category_id_foreign');
		});
		Schema::drop('category_nodes');

		Schema::table('categories', function(Blueprint $table)
		{
			$table->dropForeign('categories_parent_id_foreign');
		});
		Schema::drop('categories');
	}
}
