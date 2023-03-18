<?php

require_once '../helper/function.php';
require_once  '../orm/TransaksiDetailORM.php';

$id = $_GET['id']; //diambil dari url parameter get

$rincian_trx = TransaksiDetailORM::findOne($id); //output adalah array

if (!$rincian_trx || !$id) {
    $json['error'] = 'data tidak ada';
    echo json_encode($json);
    return;
}


$json['time'] = $rincian_trx->time;
$json['total'] = format_uang($rincian_trx->total);
$json['harga'] = format_uang($rincian_trx->harga);
$json['jumlah'] = $rincian_trx->qty;
$json['barang_id'] = $rincian_trx->barang_id;
$json['trx_detail_id'] = $rincian_trx->id;

//atur agar yang dikirimkan oleh php berupa data json
header('Content-type: application/json');
echo json_encode($json);
