<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class TcphdrTableSeeder extends Seeder {

	public function run()
	{
		Tcphdr::truncate();

		$faker = Faker::create();

		foreach (EventSnort::all() as $event) {

			Tcphdr::create([
				'sid'		=> $event->sid,
				'cid'		=> $event->cid,

				'tcp_sport'	=> $faker->randomNumber(4),
				'tcp_dport'	=> $faker->randomNumber(2),
				'tcp_seq'	=> $faker->randomNumber(4),
				'tcp_ack'	=> $faker->randomNumber(4),
				'tcp_off'	=> $faker->randomNumber(4),
				'tcp_res'	=> $faker->randomNumber(4),
				'tcp_flags'	=> $faker->randomNumber(4),
				'tcp_win'	=> $faker->randomNumber(4),
				'tcp_csum'	=> $faker->randomNumber(4),
				'tcp_urp'	=> $faker->randomNumber(4)
			]);
		}
	}

}