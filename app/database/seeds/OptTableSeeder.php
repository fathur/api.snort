<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OptTableSeeder extends Seeder {

	public function run()
	{
		Opt::truncate();

		$faker = Faker::create();

		foreach (EventSnort::all() as $event) {

			Opt::create([
				'sid'		=> $event->sid,
				'cid'		=> $event->cid,

				'optid'		=> $faker->randomNumber(2),
				'opt_proto'	=> $faker->randomNumber(2),
				'opt_code'	=> $faker->randomNumber(4),
				'opt_len'	=> $faker->randomNumber(4),
				'opt_data'	=> $faker->text(100)
			]);
		}
	}

}