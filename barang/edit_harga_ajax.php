<?php

require_once '../helper/function.php';
require_once  '../orm/HargaBarangORM.php';

$id = $_GET['id']; //diambil dari url parameter get

$harga = HargaBarangORM::findOne($id); //output adalah array

if (!$harga || !$id) {
    $json['error'] = 'data tidak ada';
    echo json_encode($json);
    return;
}


$json['error'] = '';
$json['harga'] = format_uang($harga->harga);
$json['pemasok'] = $harga->pemasok;
$json['tanggal'] =  date("d-m-Y", strtotime($harga->tanggal));
$json['harga_id'] = $harga->id;

//atur agar yang dikirimkan oleh php berupa data json
header('Content-type: application/json');
echo json_encode($json);
