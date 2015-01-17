<?php

class SigReference extends \Eloquent {
	protected $table = 'sig_reference';
	protected $fillable = ['sig_id','ref_seq','ref_id'];
	public $timestamps = false;
}