<?php

class Data extends \Eloquent {
	protected $table = "data";
	protected $fillable = ['sid','cid','data_payload'];
	public $timestamps = false;
}