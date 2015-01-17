<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Matagaruda\Setup\Tools;

class SensorTableSeeder extends Seeder {

	public function run()
	{
		Sensor::truncate();

		$faker = Faker::create();

		$detailId 	= Tools::collectId(Detail::all(),'detail_type');
		$encodingId	= Tools::collectId(Encoding::all(), 'encoding_type');

		foreach(range(1, 5) as $index)
		{
			Sensor::create([
				'hostname'	=> $faker->word(),
				'interface'	=> $faker->randomElement([
					'eth0:1','eth0:2','eth1','eth2:0',
					'snsr1','snsr2:1','snsr2:3','usb1']),
				'filter'	=> $faker->word(),
				'detail'	=> $faker->randomElement($detailId),
				'encoding'	=> $faker->randomElement($encodingId),
				'last_cid'	=> $faker->randomNumber() // Seharusnya ngambil dari tabel event yang paling besar cidnya
			]);
		}
	}

}