<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contact_nodes', function(Blueprint $table)
		{
			$table->unsignedInteger('contact_id');
			$table->char('language_id', 2);
			$table->string('city');
			$table->string('phone', 60)->nullable();
			$table->text('address')->nullable();
			$table->string('email')->nullable();
			$table->mediumText('fields')->nullable();
			$table->timestamps();

			$table->primary(['contact_id', 'language_id']);

			$table->foreign('contact_id')
				->references('id')
				->on('contacts')
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
		Schema::table('contact_nodes', function(Blueprint $table)
		{
			$table->dropForeign('contact_nodes_contact_id_foreign');
		});
		Schema::drop('contact_nodes');
	}

}
