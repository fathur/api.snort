<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncodingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('encoding', function(Blueprint $table)
		{
			$table->tinyInteger('encoding_type');
			$table->text('encoding_text');

			$table->primary('encoding_type');
		});

		Encoding::create([
			'encoding_type'	=> 0,
			'encoding_text'	=> 'hex'
		]);

		Encoding::create([
			'encoding_type'	=> 1,
			'encoding_text'	=> 'base64'
		]);

		Encoding::create([
			'encoding_type'	=> 2,
			'encoding_text'	=> 'ascii'
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('encoding');
	}

}
