<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use MataGaruda\Event\Converter as Converter;

class IphdrTableSeeder extends Seeder {

	public function run()
	{
		$converter = new Converter;
		$faker = Faker::create();

		Iphdr::truncate();

		$ip = ['192.168.10.3','203.34.119.45','10.10.1.1','127.0.0.1','163.15.97.10',
			'192.68.10.13','23.34.119.145','190.10.11.1','27.0.10.1','163.15.97.110'];

		foreach (EventSnort::all() as $event) {

			Iphdr::create([
				'sid'		=> $event->sid,
				'cid'		=> $event->cid,

				'ip_src'	=> $converter->ipToNumber($faker->randomElement($ip)),//$converter->ipToNumber($faker->ipv4),
				'ip_dst'	=> $converter->ipToNumber($faker->randomElement($ip)),//$converter->ipToNumber($faker->ipv4),
				'ip_ver'	=> 4,
				'ip_tos'	=> $faker->randomDigit(),
				'ip_len'	=> $faker->randomNumber(4),
				'ip_id'		=> $faker->randomNumber(4),
				'ip_flags'	=> $faker->randomNumber(4),
				'ip_off'	=> $faker->randomNumber(4),
				'ip_ttl'	=> $faker->randomNumber(4),
				'ip_proto'	=> $faker->randomNumber(4),
				'ip_csum'	=> $faker->randomNumber(4)
			]);
		}
	}

}