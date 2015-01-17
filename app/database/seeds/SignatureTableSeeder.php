<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Matagaruda\Setup\Tools;

class SignatureTableSeeder extends Seeder {

	public function run()
	{
		Signature::truncate();

		$faker = Faker::create();

		$classIds = Tools::collectId(SigClass::all(),'sig_class_id');

		foreach(range(1, 100) as $index)
		{
			Signature::create([
				'sig_name'		=> $faker->sentence(6),
				'sig_class_id'	=> $faker->randomElement($classIds),
				'sig_priority'	=> $faker->randomElement([1,2,3]),
				'sig_rev'		=> $faker->randomDigitNotNull(),
				'sig_sid'		=> $faker->randomNumber(3),
				'sig_gid'		=> $faker->randomNumber(3)
			]);
		}
	}

}