<?php

class Icmphdr extends \Eloquent {
	protected $table = "icmphdr";
	protected $fillable = ['sid','cid','icmp_type','icmp_code','icmp_csum','icmp_id','icmp_seq'];
	public $timestamps = false;
}