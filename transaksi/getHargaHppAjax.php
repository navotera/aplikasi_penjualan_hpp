<?php

require_once  '../orm/HppORM.php';
require_once  '../orm/TransaksiDetailORM.php';
require_once  '../helper/function.php';
require_once  '../helper/FIFO.php';

$post = (object) $_POST;


$barang_id = $post->barang_id;
$jumlah_jual = $post->jumlah;

// baris dibawah digunakan untuk mendapatkan stok dan harga pada stok tersebut
//$item_list = FIFO::getAvailableListStock($barang_id);

$fifo = FIFO::calculate_HPP($barang_id, $jumlah_jual);


$json['harga_hpp'] = array_sum($fifo['hpp']);
// var_dump($fifo);
// exit;
echo json_encode($json);


exit;

