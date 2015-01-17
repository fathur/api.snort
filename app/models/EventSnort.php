<?php

class EventSnort extends \Eloquent {
	protected $table = 'event';
	protected $fillable = ['sid','cid','signature','timestamp'];
	public $timestamps = false;
}