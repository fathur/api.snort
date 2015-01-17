<?php namespace Snort\Event; 

/**
 * @author Fathur Rohman <fathur_rohman17@yahoo.co.id>
 */
interface EventInterface {

	/**
	 * Untuk $range dan $density hanya menerima input dengan format
	 * [x]s, [x]m, [x]h, [x]d, [x]i, [x]y. Dengan x adalah unsigned
	 * integer; dan s = seconds, m = minutes, h = hours, d = days, 
	 * i = months, dan y = years. Contoh 4d = 4 hari, 10i = 10 bulan.
	 * 		
	 * @param  int 		$total   	Jumlah data yang ditampilkan
	 * @param  string 	$range   	Rentang waktu data yang ditampilkan
	 * @param  string 	$density 	Kerapatan antara satu data dengan 
	 *                          	data yang lain saat ditampilkan
	 */
	public function __construct($total, $range, $density);

	/**
	 * [getDetailPerItem description]
	 * @param  [type] $item [description]
	 * @return [type]       [description]
	 */
	public function getDetailPerItem($item);

	/**
	 * Mendapatkan data query yang sudah di format untuk ditampilkan.
	 * 		
	 * @return array 	Formatted data
	 */
	public function getFormattedData();

	/**
	 * Mendapatkan top jumlah event yang terjadi. 
	 * Hanya menampilkan yang paling banyak.
	 * 
	 * @param  int 		$total 	Jumlah teratas yang akan ditampilkan
	 * @param  string 	$range 	Rentang waktu yang akan digunakan 
	 *                         	untuk menampilkan. Menggunakan format
	 *                         	[x]h, [x]d, [x]w, [x]m, [x]y. 
	 *                         	Dimana [x] adalah angka
	 * @return DB 				Hasil Query
	 */
	public function getTop();
}