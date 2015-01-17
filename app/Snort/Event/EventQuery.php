<?php namespace Snort\Event;

use DB;

class EventQuery extends Query
{
	/**
	 * [$limit description]
	 * @var [type]
	 */
	protected $limit;

	/**
	 * [__construct description]
	 * @param integer $limit [description]
	 */
	public function __construct($limit = 100)
	{
		$this->limit = $limit;
	}

	/**
	 * [getRecent description]
	 * @return [type] [description]
	 */
	public function getRecent()
	{
		$query = DB::table('event')
			->select('*')
			->orderBy('event.timestamp', 'desc')
			->limit($this->limit)
			->get();

		return $query;
	}

	public function getDetail($sid, $cid)
	{
		$query = DB::table('event')
			->select('*')
			// ->join()
			->where('event.sid','=',$sid)
			->where('event.cid','=',$cid)

			->get();

		return $query;
	}
}