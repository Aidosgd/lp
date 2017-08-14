<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewslettersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newsletters', function(Blueprint $table) {

			$table->increments('id');
			$table->unsignedInteger('subscription_id');
			$table->string('type');
			$table->string('subject');
			$table->char('language_id', 2);
			$table->mediumText('content')->nullable();
			$table->tinyInteger('enabled')->default(0);
			$table->unsignedInteger('interval')->nullable();
			$table->timestamp('last_sended')->nullable();

			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newsletters');
	}

}
