<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu', function(Blueprint $table)
		{

			$table->increments('id');
			$table->unsignedInteger('parent_id')->nullable();
			$table->integer('lft')->nullable()->index();
			$table->integer('rgt')->nullable()->index();
			$table->integer('depth')->nullable();
			$table->string('link')->nullable();
			$table->string('linkable_type')->nullable();
			$table->unsignedInteger('linkable_id')->nullable();
			$table->timestamps();

			$table->foreign('parent_id')
				->references('id')
				->on('menu')
				->onUpdate('cascade')
				->onDelete('set null');

		});

		Schema::create('menu_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('menu_id');
			$table->char('language_id', 2);
			$table->unsignedBigInteger('image_id')->nullable();
			$table->string('title');
			$table->text('description')->nullable();

			$table->primary(['menu_id', 'language_id']);

			$table->foreign('menu_id')
				->references('id')
				->on('menu')
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
		Schema::table('menu_nodes', function(Blueprint $table)
		{
			$table->dropForeign('menu_nodes_menu_id_foreign');
		});
		Schema::drop('menu_nodes');

		Schema::table('menu', function(Blueprint $table)
		{
			$table->dropForeign('menu_parent_id_foreign');
		});
		Schema::drop('menu');
	}

}
