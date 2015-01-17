<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use MataGaruda\Setup\Tools;

class ReferenceTableSeeder extends Seeder {

	public function run()
	{
		Reference::truncate();

		$faker = Faker::create();

		$reId = Tools::collectId(ReferenceSystem::all(), 'ref_system_id');

		foreach(range(1, 10) as $index)
		{
			Reference::create([
				'ref_system_id'	=> $faker->randomElement($reId),
				'ref_tag'		=> $faker->text(50)
			]);
		}
	}

}