<?php

class Reference extends \Eloquent {
	protected $table = 'reference';
	protected $fillable = ['ref_system_id'];
	public $timestamps = false;
}