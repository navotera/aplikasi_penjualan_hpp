<?php

require_once  '../orm/BarangORM.php';
require_once  '../orm/TransaksiDetailORM.php';
require_once  '../helper/function.php';
require_once '../constants.php';

$barangID = $_GET['barangId'];


$lastPembelian = TransaksiDetailORM::order_by_desc('id')
    ->where('barang_id', $barangID)
    ->where('jenis', PEMBELIAN)
    ->where_not_equal('status_temporary', 1)
    ->findOne();

//echo ORM::get_last_query();
$barang = BarangORM::findOne();

$json['harga'] = format_uang($lastPembelian->harga);
$json['pemasok']  = $barang->pemasok;

echo json_encode($json);
