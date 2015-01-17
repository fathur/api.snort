<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use MataGaruda\Event\Converter as Converter;

class DataTableSeeder extends Seeder {

	public function run()
	{
		Data::truncate();

		$faker = Faker::create();

		foreach (EventSnort::all() as $event) {

			Data::create([
				'sid'		=> $event->sid,
				'cid'		=> $event->cid,
				'data_payload'	=> (new Converter)->stringToHex($faker->text())
			]);
			
		}
	}

}