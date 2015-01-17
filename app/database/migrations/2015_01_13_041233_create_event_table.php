<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event', function(Blueprint $table)
		{
			$table->integer('sid')->unsigned();
			$table->integer('cid')->unsigned();
			$table->integer('signature')->unsigned();
			$table->dateTime('timestamp');

			$table->primary(['sid','cid']);
			$table->index('signature');
			$table->index('timestamp');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event');
	}

}
