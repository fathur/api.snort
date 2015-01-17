<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignatureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('signature', function(Blueprint $table)
		{
			$table->increments('sig_id');
			$table->string('sig_name');
			$table->integer('sig_class_id')->unsigned();
			$table->integer('sig_priority')->unsigned()->nullable();
			$table->integer('sig_rev')->unsigned()->nullable();
			$table->integer('sig_sid')->unsigned()->nullable();
			$table->integer('sig_gid')->unsigned()->nullable();
			
			$table->index('sig_name');
			$table->index('sig_class_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('signature');
	}

}
