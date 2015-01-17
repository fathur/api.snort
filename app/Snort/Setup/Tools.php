<?php namespace Snort\Setup;

class Tools
{
	/**
	 * Mengambil id dari Eloquent query dan 
	 * mengumpulkannya dalam satu array
	 * 
	 * @param  object 	$object  
	 * @param  string 	$idField 	Nama field ID yang dimaksud
	 * @return array          
	 */
	public static function collectId($object, $idField = 'id')
	{
		$arrayId = [];

		foreach ($object as $item) {
			array_push($arrayId, $item->{$idField});
		}

		return $arrayId;
	}
}