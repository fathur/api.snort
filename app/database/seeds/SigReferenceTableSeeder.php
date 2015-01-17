<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Matagaruda\Setup\Tools;

class SigReferenceTableSeeder extends Seeder {

	public function run()
	{
		SigReference::truncate();

		$faker = Faker::create();

		$sigIds = Tools::collectId(Signature::all(), 'sig_id');
		$refIds = Tools::collectId(Reference::all(), 'ref_id');

		foreach(range(1, 10) as $index)
		{
			SigReference::create([
				'sig_id'	=> $faker->randomElement($sigIds),
				'ref_seq'	=> $faker->randomNumber(),
				'ref_id'	=> $faker->randomElement($refIds)
			]);
		}
	}

}