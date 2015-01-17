<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SigClassTableSeeder extends Seeder {

	public function run()
	{
		SigClass::truncate();

		$faker = Faker::create();

		foreach(range(1, 40) as $index)
		{
			SigClass::create([
				'sig_class_name'	=> $faker->sentence(5)
			]);
		}
	}

}