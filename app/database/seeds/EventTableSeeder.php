<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use MataGaruda\Setup\Tools;

class EventTableSeeder extends Seeder {

	public function run()
	{
		//EventSnort::truncate();

		$faker = Faker::create();

		$sensorIds 		= Tools::collectId(Sensor::all(),'sid');
		$signatureIds 	= Tools::collectId(Signature::all(),'sig_id');

		foreach(range(1, 200) as $index)
		{
			$sid = $faker->randomElement($sensorIds);
			$cid = $faker->unique()->randomNumber(5);

			// Check kombinasi sid dan cid sudah ada atau belum
			$checkQuery = DB::table('event')
				->select('*')
				->where('sid','=',$sid)
				->where('cid','=',$cid)
				->get();

			if (count($checkQuery) == 0) {

				EventSnort::create([
					'sid'	=> $sid,
					'cid'	=> $cid,
					'signature'	=> $faker->randomElement($signatureIds),
					'timestamp'	=> $faker->dateTimeThisYear()
				]);
			}
		}
	}

}