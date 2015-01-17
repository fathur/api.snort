<?php namespace Snort\Event;

use Carbon\Carbon;

class Converter
{

	/**
	 * Convert number to ip address
	 * @param  int $number 
	 * @return string         ip address
	 */
	public function numberToIp($number)
	{
		$oct4 = ($number - fmod($number,16777216)) / 16777216;
		$oct3 = (fmod($number,16777216) - (fmod($number,16777216) % 65536)) / 65536;
		$oct2 = (fmod($number,16777216) % 65536 - (fmod($number , 16777216) % 65536 % 256)) / 256;
		$oct1 = fmod($number , 16777216) % 65536 % 256;
		$ip = $oct4 . "." . $oct3 . "." . $oct2 . "." . $oct1;
		return $ip;
	}

	/**
	 * Convert ip to number
	 * @param  string $ip Ip address
	 * @return int     
	 */
	public function ipToNumber($ip)
	{
		$dec = 0.0;
	
		$val = explode('.', $ip);
		for ($i=0; $i<count($val); $i++){
			$dec 	= ($dec * 256.0);
			$dec	+= ($val[$i] * 1.0);
		}
	
		return $dec;
	}

	/**
	 * String to hex converter
	 * @param  string $string 
	 * @return string         
	 */
	public function stringToHex($string)
	{
		$hex='';
		
		for ($i=0; $i < strlen($string); $i++)
		{
			$hex .= dechex(ord($string[$i]));
		}

		return strtoupper($hex);
	}

	/**
	 * Hexdecimal to string converter
	 * @param  string $hex 
	 * @return string      
	 */
	public function hexToString($hex)
	{
		$str = '';
	
		$i = 0;
		
		while ($i < strlen($hex)) {
		
			$tmp = hexdec(substr($hex,$i,2));
	
			if ($tmp < 32) $tmp = 46;			//protect against control characters
			if ($tmp > 126) $tmp = 46;
			$tmp = chr($tmp);
			if ($tmp == "<") $tmp = "&lt";		//protect against HTML payloads
			if ($tmp == ">") $tmp = "&gt";
	
			$str .= $tmp;
			$i += 2;
		}

		return $str;
	}

	public function convertRangeTime($range)
	{
		//dd($range);

		// Mendapatkan string terakhir, apakah h/d/w/m/y
		$timeKey = substr($range, -1);

		// Mendapatkan angkanya saja
		$number	= (int) substr($range, 0, -1);



		switch ($timeKey) {

			# seconds
			case 's':
				$beginDate = Carbon::now()->subSeconds($number)->timezone("Asia/Jakarta");
				$formatDate = '%Y-%m-%d %H:%i:%s';
				break;

			# minutes
			case 'i':
				$beginDate = Carbon::now()->subMinutes($number)->timezone("Asia/Jakarta");
				$formatDate = '%Y-%m-%d %H:%i';
				break;

			# hours
			case 'h':
				$beginDate = Carbon::now()->subHours($number)->timezone("Asia/Jakarta");
				$formatDate = '%Y-%m-%d %H:00';
				break;
			
			#day
			case 'd':
				$beginDate = Carbon::now()->subDays($number)->timezone("Asia/Jakarta");
				$formatDate = '%Y-%m-%d';
				break;
			
			# week
			/*case 'w':
				$beginDate = Carbon::now()->subWeeks($number);
				$formatDate = '%Y-%m-%d %H:%i:%s'; //
				break;*/
			
			# month
			case 'm':
				$beginDate = Carbon::now()->subMonths($number)->timezone("Asia/Jakarta");
				$formatDate = '%Y-%m';
				break;
			
			# year
			case 'y':
				$beginDate = Carbon::now()->subYears($number)->timezone("Asia/Jakarta");
				$formatDate = '%Y';
				break;
			
			
		}

		return [
			'beginDate' => $beginDate,
			'formatDate' => $formatDate
		];
	}
}