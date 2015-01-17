<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensor', function(Blueprint $table)
		{
			$table->increments('sid');
			$table->text('hostname');
			$table->text('interface');
			$table->text('filter');
			$table->tinyInteger('detail');
			$table->tinyInteger('encoding');
			$table->integer('last_cid')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sensor');
	}

}
