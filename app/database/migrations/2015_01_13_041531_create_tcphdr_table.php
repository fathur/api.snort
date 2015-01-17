<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTcphdrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tcphdr', function(Blueprint $table)
		{
			$table->integer('sid')->unsigned();
			$table->integer('cid')->unsigned();
			$table->smallInteger('tcp_sport')->unsigned();
			$table->smallInteger('tcp_dport')->unsigned();
			$table->integer('tcp_seq')->unsigned()->nullable();
			$table->integer('tcp_ack')->unsigned()->nullable();
			$table->tinyInteger('tcp_off')->unsigned()->nullable();
			$table->tinyInteger('tcp_res')->unsigned()->nullable();
			$table->tinyInteger('tcp_flags')->unsigned();
			$table->smallInteger('tcp_win')->unsigned()->nullable();
			$table->smallInteger('tcp_csum')->unsigned()->nullable();
			$table->smallInteger('tcp_urp')->unsigned()->nullable();

			$table->primary(['sid','cid']);
			$table->index('tcp_sport');
			$table->index('tcp_dport');
			$table->index('tcp_flags');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tcphdr');
	}

}
