<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTermNodesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('term_nodes', function(Blueprint $table)
		{
			$table->foreign('term_id')
				->references('id')
				->on('terms')
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
		Schema::table('term_nodes', function(Blueprint $table)
		{
			$table->dropForeign('term_nodes_term_id_foreign');
		});
	}

}
