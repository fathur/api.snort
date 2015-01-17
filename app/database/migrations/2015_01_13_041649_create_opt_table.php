<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opt', function(Blueprint $table)
		{
			$table->integer('sid')->unsigned();
			$table->integer('cid')->unsigned();
			$table->integer('optid')->unsigned();
			$table->tinyInteger('opt_proto')->unsigned();
			$table->tinyInteger('opt_code')->unsigned();
			$table->smallInteger('opt_len')->unsigned()->nullable();
			$table->text('opt_data')->nullable();

			$table->primary(['sid','cid','optid']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('opt');
	}

}
