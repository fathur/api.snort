<?php

class Udphdr extends \Eloquent {
	protected $table = "udphdr";
	protected $fillable = ['sid','cid',
		'udp_sport','udp_dport','udp_len','udp_csum'];
	public $timestamps = false;
}