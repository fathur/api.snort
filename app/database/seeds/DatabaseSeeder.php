<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		
		/*$this->call('SigClassTableSeeder');
		$this->call('ReferenceSystemTableSeeder');
		$this->call('ReferenceTableSeeder');
		$this->call('SignatureTableSeeder');
		$this->call('SigReferenceTableSeeder');
		$this->call('SensorTableSeeder');*/

		$this->call('EventTableSeeder');
		$this->call('IcmphdrTableSeeder');
		$this->call('TcphdrTableSeeder');
		$this->call('UdphdrTableSeeder');
		$this->call('IphdrTableSeeder');
		$this->call('OptTableSeeder');
		$this->call('DataTableSeeder');

		
	}

}
