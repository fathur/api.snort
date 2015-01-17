<?php

use Snort\Event\SensorQuery as Sensor;

class SensorController extends ApiController
{
	
	/**
	 * GET /sensor
	 */
	public function getIndex()
	{
		# code...
	}

	/**
	 * GET /sensor/[sid]
	 * 
	 * @param integer 	$sid 	Sensor ID
	 */
	public function getSensorInformation($sid)
	{
		# code...
	}
	
	/**
	 * GET /sensor/top
	 */
	public function getTop()
	{
		// Get Parameters
		$total		= Input::get('total', 10);
		$range		= Input::get('range', '24h');
		$density	= Input::get('density', '1h');

		// New instance of Sensor()
		$sensor = new Sensor($total, $range, $density);

		return $sensor->getTop();
	}
	
	/**
	 * GET /sensor/top/detail
	 */
	public function getDetailTop()
	{
		// Get Parameters
		$total		= Input::get('total', 10);
		$range		= Input::get('range', '24h');
		$density	= Input::get('density', '1h');

		// New instance of Sensor()
		$sensor = new Sensor($total, $range, $density);

		// Validation goes below
		// ...

		// Call formatted data
		$data = $sensor->getFormattedData();

		// Just for debugging
		$log = Input::get('log');

		if ($log) {
			switch ($log) {
				case 'print':
					print_r(DB::getQueryLog());
					break;
				case 'dd':
					dd(DB::getQueryLog());
					break;
				
				default:
					dd(DB::getQueryLog());
					break;
			}
		} 

		else 
		{
			return $data;
		}
	}
}