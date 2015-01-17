<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSigClassTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sig_class', function(Blueprint $table)
		{
			$table->increments('sig_class_id');
			$table->string('sig_class_name', 60);

			$table->index('sig_class_id');
			$table->index('sig_class_name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sig_class');
	}

}
