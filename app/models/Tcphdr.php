<?php

class Tcphdr extends \Eloquent {
	protected $table = "tcphdr";
	protected $fillable = ['sid','cid',
		'tcp_sport','tcp_dport','tcp_seq','tcp_ack','tcp_off',
		'tcp_res','tcp_flags','tcp_win','tcp_csum','tcp_urp'];
	public $timestamps = false;
}