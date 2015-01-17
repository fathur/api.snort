<?php

/**
* 
*/
class RuleController extends ApiController
{

	function __construct()
	{
		$this->beforeFilter('auth.basic', ['on' => 'post']);
	}

	/**
	 * Mendapatkan semua list file yang ada
	 * @return string 
	 */
	public function getIndex()
	{
		
	}

	/**
	 * Mendapatkan isi dari file 
	 * yang dimaksud
	 * @param  string $filename 
	 * @return string           
	 */
	public function getFile($filename)
	{
		# code...
	}

	/**
	 * Mendapatkan rule di suatu file
	 * @param  string $filename 
	 * @param  int $line     
	 * @return string           
	 */
	public function getRule($filename, $line)
	{
		# code...
	}
	
	/**
	 * Membuat rule baru di suatu file
	 * @param  string $filename 
	 * @return boolean           
	 */
	public function postRule()
	{
		# code...
	}

	/**
	 * Membuat file rule baru
	 * @return boolean 
	 */
	public function postFile()
	{
		# code...
	}

	/**
	 * [putRule description]
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	public function putRule()
	{
		# code...
	}

	/**
	 * [putEnableRule description]
	 * @param  [type] $filename [description]
	 * @param  [type] $line     [description]
	 * @return [type]           [description]
	 */
	public function putEnableRule()
	{
		# code...
	}

	/**
	 * [putDisableRule description]
	 * @param  [type] $filename [description]
	 * @param  [type] $line     [description]
	 * @return [type]           [description]
	 */
	public function putDisableRule()
	{
		# code...
	}

	/**
	 * [deleteFile description]
	 * @return [type] [description]
	 */
	public function deleteFile()
	{
		# code...
	}

	/**
	 * [deleteRule description]
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	public function deleteRule()
	{
		# code...
	}
}