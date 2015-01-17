<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detail', function(Blueprint $table)
		{
			$table->tinyInteger('detail_type')->unsigned();
			$table->text('detail_text');

			$table->primary('detail_type');
		});

		Detail::create([
			'detail_type'	=> 0,
			'detail_text'	=> 'fast'
		]);

		Detail::create([
			'detail_type'	=> 1,
			'detail_text'	=> 'full'
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detail');
	}

}
