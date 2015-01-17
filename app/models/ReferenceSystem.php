<?php

class ReferenceSystem extends \Eloquent {
	protected $table = 'reference_system';
	protected $fillable = ['ref_system_name'];
	public $timestamps = false;
}