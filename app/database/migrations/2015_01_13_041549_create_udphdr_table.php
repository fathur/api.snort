<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUdphdrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('udphdr', function(Blueprint $table)
		{
			$table->integer('sid')->unsigned();
			$table->integer('cid')->unsigned();
			$table->smallInteger('udp_sport')->unsigned();
			$table->smallInteger('udp_dport')->unsigned();
			$table->smallInteger('udp_len')->unsigned()->nullable();
			$table->smallInteger('udp_csum')->unsigned()->nullable();

			$table->primary(['sid','cid']);
			$table->index('udp_sport');
			$table->index('udp_dport');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('udphdr');
	}

}
