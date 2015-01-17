<?php

use Snort\Event\PortDestinationQuery as PortDestination;
use Snort\Event\PortSourceQuery as PortSource;


/**
* 
*/
class PortController extends ApiController
{
	
	public function getTopSource()
	{
		// Get Parameters
		$total		= Input::get('total', 10);
		$range		= Input::get('range', '24h');
		$density	= Input::get('density', '1h');

		// New instance of AttackerIp()
		$attackerIp = new PortSource($total, $range, $density);

		// Validation goes below
		// ...

		// Call formatted data
		$data = $attackerIp->getFormattedData();

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

	public function getTopDestination()
	{
		// Get Parameters
		$total		= Input::get('total', 10);
		$range		= Input::get('range', '24h');
		$density	= Input::get('density', '1h');

		// New instance of AttackerIp()
		$attackerIp = new PortDestination($total, $range, $density);

		// Validation goes below
		// ...

		// Call formatted data
		$data = $attackerIp->getFormattedData();

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