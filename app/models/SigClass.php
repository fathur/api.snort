<?php

class SigClass extends \Eloquent {
	protected $table = "sig_class";
	protected $fillable = ['sig_class_name'];
	public $timestamps = false;
}