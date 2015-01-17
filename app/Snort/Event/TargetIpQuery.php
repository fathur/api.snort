<?php namespace Snort\Event;

use Carbon\Carbon;
use DB;

class TargetIpQuery extends Query implements EventInterface
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
		$converter 		= new Converter;
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
	 * [getDetailPerItem description]
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	public function getDetailPerItem($item) 
	{
		$query = DB::table('event')
			->select('iphdr.ip_dst', 
				DB::raw("DATE_FORMAT(event.timestamp, '". $this->formatDate ."') AS waktu"),
				DB::raw("COUNT(iphdr.ip_dst) AS count"))
			->join('iphdr', function($join) {
				$join->on('event.sid','=','iphdr.sid');
				$join->on('event.cid','=','iphdr.cid');
			})
			->where('iphdr.ip_dst','=', $item)
			->whereBetween('event.timestamp', [$this->beginDate, $this->endDate])
			->groupBy('waktu')
			->get();

		return $query;
	}

	/**
	 * [getFormattedData description]
	 * @return [type] [description]
	 */
	public function getFormattedData() {
		
		$converter = new Converter;
		
		$topip = $this->getTop();

		$result = [];
		foreach ($topip as $ip) {
			
			$transforms = array_map(function($i) {
				
				return [
					'time'	=> $i->waktu,
					'count'	=> $i->count
				];

			}, $this->getDetailPerItem($ip->ip_dst) );


			array_push($result, [
				'ip'		=> $converter->numberToIp($ip->ip_dst),
				'number'	=> (int) $ip->ip_dst,
				'dataset'	=> $transforms
			]);
		}

		return $result;
	}
	
	/**
	 * [getTop description]
	 * @return [type] [description]
	 */
	public function getTop() 
	{
		
		$query = DB::table('event')
			->select('iphdr.ip_dst', DB::raw('COUNT(iphdr.ip_dst) AS count'))
			->join('iphdr', function($join) {
				$join->on('event.sid','=','iphdr.sid');
				$join->on('event.cid','=','iphdr.cid');
			})
			->groupBy('iphdr.ip_dst')
			->orderBy('count','DESC')
			->limit($this->total);
			
		if ($this->total != 0) 
			$query->limit($this->total);
		

		if ($this->range) 
			$query->whereBetween('event.timestamp', [$this->beginDate, $this->endDate]);
		

		$query = $query->get();

		return $query;
	}
}