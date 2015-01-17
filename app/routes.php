<?php

use Snort\Setup\Tools;
use Snort\Event\EventQuery as Ev;

/**
 * 
 */

// Register your main domain url here
$mainDomain = 'snort.lo';

/**
 * Route for api v1.0
 */
Route::group([

	'prefix' 	=> '1.0',
	'domain'	=> 'api.snort.lo'

], function() {

	/**
	 * Route group Attacker
	 */
	Route::group(['prefix'=>'attacker'], function() {

		Route::get('top-ip', [
			'uses' => 'AttackerController@getTopIp',
			'as' => 'attacker.topip'
		]);
		Route::get('top-ip/detail', [
			'uses' => 'AttackerController@getDetailTopIp',
			'as' => 'attacker.topip.detail'
		]);
		Route::get('top-port', [
			'uses' => 'AttackerController@getTopPort',
			'as' => 'attacker.topport'
		]);
		Route::get('top-port/detail', [
			'uses' => 'AttackerController@getDetailTopPort',
			'as' => 'attacker.topport.detail'
		]);

	});

	/**
	 * Route Group Target
	 */
	Route::group(['prefix'=>'target'], function() {

		Route::get('top-ip', [
			'uses' => 'TargetController@getTopIp',
			'as' => 'target.ip'
		]);
		Route::get('top-ip/detail', [
			'uses' => 'TargetController@getDetailTopIp',
			'as' => 'target.ip.detail'
		]);
		Route::get('top-port', [
			'uses' => 'TargetController@getTopPort',
			'as' => 'target.port'
		]);
		Route::get('top-port/detail', [
			'uses' => 'TargetController@getDetailTopPort',
			'as' => 'target.port.detail'
		]);

	});


	/**
	 * Route Group Sensor
	 */
	Route::group(['prefix' => 'sensor'], function() {

		Route::get('/', [
			'uses' => 'SensorController@getIndex',
			'as' => 'sensor.list'
		]);
		Route::get('[sid]', [
			'uses' => 'SensorController@getSensorInformation',
			'as' => 'sensor.info'
		]);
		Route::get('top', [
			'uses' => 'SensorController@getTop',
			'as' => 'sensor.top'
		]);
		Route::get('top/detail', [
			'uses' => 'SensorController@getDetailTop',
			'as' => 'sensor.top.detail'
		]);

	});

	
	Route::get('protocol/top', [
		'uses' => 'ProtocolController@getTop',
		'as' => 'protocol.top'
	]);
	Route::get('protocol/top/detail', [
		'uses' => 'ProtocolController@getDetailTop',
		'as' => 'protocol.top.detail'
	]);

	Route::get('signature/top', [
		'uses' => 'SignatureController@getTop',
		'as' => 'signature.top'
	]);
	Route::get('signature/top/detail', [
		'uses' => 'SignatureController@getDetailTop',
		'as' => 'signature.top.detail'
	]);

	Route::get('event/recent', [
		'uses' => 'EventController@getRecent',
		'as' => 'event.recent'
	]);
	Route::get('event/[sid].[cid]', [
		'uses' => 'EventController@getSingle',
		'as' => 'event.single'
	]);


});


/**
 * Route for website application
 */
Route::group([

	'domain'	=> $mainDomain

], function() {

	Route::get('/', function() {
		
	});

});