<?php namespace Snort\Event;

use Carbon\Carbon;
use DB;

class PortDestinationQuery extends Query implements EventInterface
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
	 * [getDetailPerItem description]
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	public function getDetailPerItem($item)
	{
		$query = DB::table('event')
			->select('tcphdr.tcp_dport', 
				DB::raw("DATE_FORMAT(event.timestamp, '". $this->formatDate ."') AS waktu"),
				DB::raw("COUNT(tcphdr.tcp_dport) AS count"))
			->join('tcphdr', function($join) {
				$join->on('event.sid','=','tcphdr.sid');
				$join->on('event.cid','=','tcphdr.cid');
			})
			->where('tcphdr.tcp_dport','=', $item)
			->whereBetween('event.timestamp', [$this->beginDate, $this->endDate])
			->groupBy('waktu')
			->get();

		return $query;
	}

	/**
	 * [getFormattedData description]
	 * @return [type] [description]
	 */
	public function getFormattedData()
	{

		$converter = new Converter; 
		
		$topports = $this->getTop();

		$result = [];
		foreach ($topports as $port) {
			
			$transforms = array_map(function($i) {
				
				return [
					'time'	=> $i->waktu,
					'count'	=> $i->count
				];

			}, $this->getDetailPerItem($port->tcp_dport) );


			array_push($result, [
				'port'		=> (int) $port->tcp_dport,
				'dataset'	=> $transforms
			]);
		}

		return $result;
	}

	/**
	 * Mendapatkan ip dan jumlahnya yang paling banyak
	 * 
	 * @param  int 				$total  Jika ingin menampilkan semua = 0 
	 * @param  string/boolean 	$range 	Jika ingin tidak menampilkan range = false
	 * @return object           
	 */
	public function getTop()
	{
		$query = DB::table('event')
			->select('tcphdr.tcp_dport', DB::raw('COUNT(tcphdr.tcp_dport) AS count'))
			->join('tcphdr', function($join) {
				$join->on('event.sid','=','tcphdr.sid');
				$join->on('event.cid','=','tcphdr.cid');
			})
			->groupBy('tcphdr.tcp_dport')
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