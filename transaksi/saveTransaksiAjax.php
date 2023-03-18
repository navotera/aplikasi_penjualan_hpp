<?php
//initiate the session
session_start();



/**
 * *contoh data
 *trx_id: 
 *trx_detail_id: 
 *barang_id: 1
 *pemasok: UFO Elektronik
 *harga: 200.001
 *jumlah: 2
 *total: 400.000
 */

$post = (object) $_POST;


require_once  '../orm/TransaksiDetailORM.php';
require_once  '../constants.php';

$isExist = (isset($post->trx_detail_id)) ? TransaksiDetailORM::where('id', $post->trx_detail_id)->findOne() : false;

$trx_detail = ($isExist) ?: TransaksiDetailORM::create();
var_dump($post);

$trx_detail->user_id = $_SESSION['UserID'];
$trx_detail->time = $post->time;
$trx_detail->barang_id = $post->barang_id;
$trx_detail->harga = str_replace(".", "", $post->harga_perunit);
$trx_detail->qty = $post->jumlah;
$trx_detail->total = $trx_detail->harga * $post->jumlah;

$trx_detail->jenis = $post->jenis;

$trx_detail->save();
