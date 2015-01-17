<?php namespace Snort\Event;

use Carbon\Carbon;
use DB;

class ProtocolQuery extends Query implements EventInterface
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
		$this->endDate 		= Carbon::now()->timezone("Asia/Jakarta");
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
			->select('iphdr.ip_proto', 
				DB::raw("DATE_FORMAT(event.timestamp, '". $this->formatDate ."') AS waktu"),
				DB::raw("COUNT(iphdr.ip_proto) AS count"))
			->join('iphdr', function($join) {
				$join->on('event.sid','=','iphdr.sid');
				$join->on('event.cid','=','iphdr.cid');
			})
			->where('iphdr.ip_proto','=', $item)
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
		
		$topProtocols = $this->getTop();

		$result = [ 'data' => [], 'parameters' => [
			'total'	=> (int) $this->total,
			'range' => $this->range,
			'density' => $this->density
		]];

		foreach ($topProtocols as $protocol) {
			
			$transforms = array_map(function($i) {
				
				return [
					'time'	=> $i->waktu,
					'count'	=> $i->count
				];

			}, $this->getDetailPerItem($protocol->ip_proto) );


			array_push($result['data'], [
				'protocol'	=> (int) $protocol->ip_proto,
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
			->select('iphdr.ip_proto', DB::raw('COUNT(iphdr.ip_proto) AS count'))
			->join('iphdr', function($join) {
				$join->on('event.sid','=','iphdr.sid');
				$join->on('event.cid','=','iphdr.cid');
			})
			->groupBy('iphdr.ip_proto')
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