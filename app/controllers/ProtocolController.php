<?php

use Snort\Event\ProtocolQuery as Protocol;

class ProtocolController extends ApiController
{
	
	public function getTop()
	{
		// Get Parameters
		$total		= Input::get('total', 10);
		$range		= Input::get('range', '24h');
		$density	= Input::get('density', '1h');

		// New instance of AttackerIp()
		$attackerIp = new Protocol($total, $range, $density);

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