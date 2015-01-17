<?php

use MataGaruda\Setup\Migration as Mgm;

/**
 * 
 */

// Register your main domain url here
$mainDomain = 'snort.lo';

/**
 * Route for api v1.0
 */
Route::group([

	'prefix' 	=> 'v1.0',
	'domain'	=> 'api.snort.lo'

], function() {

	Route::get('attacker/top-ip', [
		'uses'	=> 'AttackerController@getTopIp',
		'as'	=> 'attacker.topip'
	]);

	Route::get('target/top-ip', [
		'uses'	=> 'TargetController@getTopIp',
		'as'	=> 'target.topip'
	]);
	
	Route::get('port/src/top', [
		'uses'	=> 'PortController@getTopSource',
		'as'	=> 'port.topsrc'
	]);

	Route::get('port/dst/top', [
		'uses'	=> 'PortController@getTopDestination',
		'as'	=> 'port.topdst'
	]);

	Route::get('protocol/top', [
		'uses'	=> 'ProtocolController@getTop',
		'as'	=> 'protocol.top'
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