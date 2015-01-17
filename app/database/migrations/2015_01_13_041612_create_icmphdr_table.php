<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcmphdrTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('icmphdr', function(Blueprint $table)
		{
			$table->integer('sid')->unsigned();
			$table->integer('cid')->unsigned();
			$table->tinyInteger('icmp_type')->unsigned();
			$table->tinyInteger('icmp_code')->unsigned();
			$table->smallInteger('icmp_csum')->unsigned()->nullable();
			$table->smallInteger('icmp_id')->unsigned()->nullable();
			$table->smallInteger('icmp_seq')->unsigned()->nullable();

			$table->primary(['sid','cid']);
			$table->index('icmp_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('icmphdr');
	}

}
