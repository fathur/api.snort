<?php namespace Snort\Event;

use Carbon\Carbon;
use DB;

class SensorQuery extends Query implements EventInterface
{
	/**
	 * [$beginDate description]
	 * @var [type]
	 */
	protected $beginDate;

	/**
	 * [$density description]
	 * @var [type]
	 */
	protected $density;
	
	/**
	 * [$endDate description]
	 * @var [type]
	 */
	protected $endDate;

	/**
	 * [$formatDate description]
	 * @var [type]
	 */
	protected $formatDate;

	/**
	 * [$range description]
	 * @var [type]
	 */
	protected $range;

	/**
	 * [$total description]
	 * @var [type]
	 */
	protected $total;
	
	/**
	 * [__construct description]
	 * @param [type] $total   [description]
	 * @param [type] $range   [description]
	 * @param [type] $density [description]
	 */
	public function __construct($total, $range, $density)
	{
		$converter = new Converter;
		
		$rangeTime 		= $converter->convertRangeTime($range);
		$densityTime 	= $converter->convertRangeTime($density);

		$this->total 		= $total;
		$this->range 		= $range;
		$this->density 		= $density;

		$this->beginDate 	= $rangeTime['beginDate'];
		$this->endDate 		= Carbon::now();
		$this->formatDate 	= $densityTime['formatDate'];
	}

	/**
	 * [getDensisty description]
	 * @return [type] [description]
	 */
	public function getDensisty()
	{
		return $this->density;		
	}

	/**
	 * [getDensisty description]
	 * @return [type] [description]
	 */
	public function getRange()
	{
		return $this->range;		
	}

	/**
	 * [getDensisty description]
	 * @return [type] [description]
	 */
	public function getTotal()
	{
		return (int) $this->total;		
	}

	/**
	 * [getDensisty description]
	 * @return [type] [description]
	 */
	public function setDensisty($density)
	{
		$this->density = $density;
	}

	/**
	 * [getDensisty description]
	 * @return [type] [description]
	 */
	public function setRange($range)
	{
		$this->range = $range;
	}

	/**
	 * [getDensisty description]
	 * @return [type] [description]
	 */
	public function setTotal($total)
	{
		$this->total = $total;
	}
	
	public function getDetailPerItem($item)
	{
		$query = DB::table('event')
			->select('sensor.sid', 
				DB::raw("DATE_FORMAT(event.timestamp, '". $this->formatDate ."') AS waktu"),
				DB::raw("COUNT(sensor.sid) AS count"))
			->join('sensor', function($join) {
				$join->on('event.sid','=','sensor.sid');
			})
			->where('sensor.sid','=', $item)
			->whereBetween('event.timestamp', [$this->beginDate, $this->endDate])
			->groupBy('waktu')
			->get();

		return $query;
	}

	
	public function getFormattedData()
	{
		$converter = new Converter; 
		
		$topSensors = $this->getTop();

		$result = [ 'data' => [], 'parameters' => [
			'total'	=> (int) $this->total,
			'range' => $this->range,
			'density' => $this->density
		]];

		foreach ($topSensors as $sensor) {
			
			$transforms = array_map(function($i) {
				
				return [
					'time'	=> $i->waktu,
					'count'	=> $i->count
				];

			}, $this->getDetailPerItem($sensor->sid) );


			array_push($result['data'], [
				'hostname'	=> $sensor->hostname,
				'sensor'	=> (int) $sensor->sid,
				'dataset'	=> $transforms
			]);
		}

		return $result;
	}

	
	public function getTop()
	{
		$query = DB::table('event')
			->select('sensor.sid', 'sensor.hostname', DB::raw('COUNT(sensor.sid) AS count'))
			->join('sensor', function($join) {
				$join->on('event.sid','=','sensor.sid');
			})
			->groupBy('event.sid')
			->orderBy('count','DESC');
			
		if ($this->total != 0) 
			$query->limit($this->total);
		
		if ($this->range) 
			$query->whereBetween('event.timestamp', [$this->beginDate, $this->endDate]);
		
		$query = $query->get();

		return $query;
	}
}