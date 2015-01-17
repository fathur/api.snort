<?php

class Signature extends \Eloquent {
	protected $table = 'signature';
	protected $fillable = ['sig_name','sig_class_id','sig_priority',
		'sig_rev','sig_sid','sig_gid'];
	public $timestamps = false;
}