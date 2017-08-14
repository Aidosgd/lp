<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileablesForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fileables', function(Blueprint $table)
		{
			$table->foreign('file_id')
				->references('id')
				->on('files')
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
		Schema::table('fileables', function(Blueprint $table)
		{
			$table->dropForeign('fileables_file_id_foreign');
		});
	}

}
