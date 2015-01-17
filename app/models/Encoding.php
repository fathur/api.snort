<?php

class Encoding extends \Eloquent {
	protected $table = 'encoding';
	protected $fillable = ['encoding_type','encoding_text'];
	public $timestamps = false;
}