<?php

class Detail extends \Eloquent {
	protected $table = 'detail';
	protected $fillable = ['detail_type','detail_text'];
	public $timestamps = false;
}