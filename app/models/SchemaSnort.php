<?php

class SchemaSnort extends \Eloquent {
	protected $fillable = ['vseq','ctime'];
	protected $table = 'schema';
	public $timestamps = false;
}