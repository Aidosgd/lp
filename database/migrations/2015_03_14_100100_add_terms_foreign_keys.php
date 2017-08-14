<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTermsForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('terms', function(Blueprint $table)
		{
			$table->foreign('root_id')
				->references('id')
				->on('roots')
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
		Schema::table('terms', function(Blueprint $table)
		{
			$table->dropForeign('terms_root_id_foreign');
		});
	}

}
