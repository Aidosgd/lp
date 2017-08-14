<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('new_subscribers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('name')->nullable();
			$table->char('lang', 2);
			$table->string('hash', 32)->unique();
			$table->boolean('confirmed')->default(false);
			$table->boolean('messaged')->default(false);

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
		Schema::drop('new_subscribers');
	}

}
