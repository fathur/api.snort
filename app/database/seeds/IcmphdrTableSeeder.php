<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class IcmphdrTableSeeder extends Seeder {

	public function run()
	{
		Icmphdr::truncate();

		$faker = Faker::create();

		foreach (EventSnort::all() as $event) {

			Icmphdr::create([
				'sid'		=> $event->sid,
				'cid'		=> $event->cid,
				'icmp_type'	=> $faker->randomDigitNotNull(),
				'icmp_code'	=> $faker->randomDigitNotNull(),
				'icmp_csum'	=> $faker->randomNumber(4),
				'icmp_id'	=> $faker->unique->randomNumber(4),
				'icmp_seq'	=> $faker->randomNumber(4)
			]);
		}
	}

}