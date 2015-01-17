<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon as Carbon;

class CreateSchemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schema', function(Blueprint $table)
		{
			$table->integer('vseq')->unsigned();
			$table->dateTime('ctime');

			$table->primary('vseq');
		});

		SchemaSnort::create([
			'vseq'	=> 107,
			'ctime'	=> Carbon::now()
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schema');
	}

}
