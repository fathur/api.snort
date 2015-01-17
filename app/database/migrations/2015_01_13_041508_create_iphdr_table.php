<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIphdrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iphdr', function(Blueprint $table)
		{
			$table->integer('sid')->unsigned();
			$table->integer('cid')->unsigned();
			$table->integer('ip_src')->unsigned();
			$table->integer('ip_dst')->unsigned();
			$table->tinyInteger('ip_ver')->unsigned()->nullable();
			$table->tinyInteger('ip_tos')->unsigned()->nullable();
			$table->smallInteger('ip_len')->unsigned()->nullable();
			$table->smallInteger('ip_id')->unsigned()->nullable();
			$table->tinyInteger('ip_flags')->unsigned()->nullable();
			$table->smallInteger('ip_off')->unsigned()->nullable();
			$table->tinyInteger('ip_ttl')->unsigned()->nullable();
			$table->tinyInteger('ip_proto')->unsigned();
			$table->smallInteger('ip_csum')->unsigned()->nullable();

			$table->primary(['sid','cid']);
			$table->index('ip_src');
			$table->index('ip_dst');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('iphdr');
	}

}
