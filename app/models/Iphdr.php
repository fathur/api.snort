<?php

class Iphdr extends \Eloquent {
	protected $table = "iphdr";
	protected $fillable = ['sid','cid',
		'ip_src','ip_dst','ip_ver','ip_tos','ip_len',
		'ip_id','ip_flags','ip_off','ip_ttl','ip_proto',
		'ip_csum'];
	public $timestamps = false;
}