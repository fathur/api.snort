<?php

class Opt extends \Eloquent {
	protected $table = "opt";
	protected $fillable = ['sid','cid',
		'optid','opt_proto','opt_code','opt_len','opt_data'];
	public $timestamps = false;
}