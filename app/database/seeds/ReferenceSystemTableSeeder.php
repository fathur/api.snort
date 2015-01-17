<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReferenceSystemTableSeeder extends Seeder {

	public function run()
	{
		ReferenceSystem::truncate();

		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			ReferenceSystem::create([
				'ref_system_name'	=> $faker->sentence(5)
			]);
		}
	}

}