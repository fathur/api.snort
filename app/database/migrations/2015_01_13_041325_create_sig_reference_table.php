<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSigReferenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sig_reference', function(Blueprint $table)
		{
			$table->integer('sig_id')->unsigned();
			$table->integer('ref_seq')->unsigned();
			$table->integer('ref_id')->unsigned();

			$table->primary(['sig_id','ref_seq','ref_id']);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sig_reference');
	}

}
