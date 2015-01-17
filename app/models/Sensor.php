<?php

class Sensor extends \Eloquent {
	protected $table = 'sensor';
	protected $fillable = ['hostname','interface','filter',
		'detail','encoding','last_cid'];
	public $timestamps = false;
}