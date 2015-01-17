<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UdphdrTableSeeder extends Seeder {

	public function run()
	{
		Udphdr::truncate();

		$faker = Faker::create();

		foreach (EventSnort::all() as $event) {

			Udphdr::create([
				'sid'		=> $event->sid,
				'cid'		=> $event->cid,
				'udp_sport'	=> $faker->randomNumber(4),
				'udp_dport'	=> $faker->randomNumber(2),
				'udp_len'	=> $faker->randomNumber(4),
				'udp_csum'	=> $faker->randomNumber(4)
			]);
		}
	}

}