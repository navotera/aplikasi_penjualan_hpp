<?php

session_start();
ini_set('display_errors', 1);


//require_once '../helper/function.php';
require_once  '../orm/TransaksiORM.php';
require_once  '../orm/TransaksiDetailORM.php';
require_once '../orm/HppORM.php';
require_once '../constants.php';
require_once '../helper/FIFO.php';

$post = (object) $_POST;



//inisiasi nilai awal dengan berasumsi bahwa bukan record baru
$isNewRecord = ($post->id === '') ? true : false;

$jenisTransaksi = $post->jenis;

$trx = ($isNewRecord) ? TransaksiORM::create() : TransaksiORM::findOne($post->id);
$trx->tanggal = date("Y-m-d", strtotime($post->tanggal));
$trx->kode = $post->kode;

// 2 adalah penjualan
if ($jenisTransaksi == PENJUALAN) {
    $trx->pelanggan_id = $post->pelanggan_id;
}
//1 adalah pembelian
if ($jenisTransaksi == PEMBELIAN) {
    $trx->supplier_id = $post->supplier_id;
}



$trx->user_id = $_SESSION['UserID'];
$trx->jenis = $jenisTransaksi;
$trx->save();


if ($isNewRecord) {

    //cari transaksi detail yang masih berstatus temporary 
    $trx_detail = TransaksiDetailORM::where('time', $post->time)->where('user_id', $post->user_id)->findMany();

    foreach ($trx_detail as $item) {
        $item->transaksi_id = $trx->id;
        $item->status_temporary = 0;
        $item->save();

        //simpan ke tabel HPP
        $hpp = HppORM::create();
        $hpp->barang_id = $item->barang_id;
        $hpp->transaksi_id = $trx->id;
        $hpp->tanggal = $trx->tanggal;
        $hpp->harga = $item->harga;
        $hpp->qty = $item->qty;
        $hpp->sisa = $item->qty;
        $hpp->jenis = $jenisTransaksi;
        $hpp->save();

        //update stock untuk transaksi penjualan

        if ($jenisTransaksi == PENJUALAN) :
            // echo '1';
            // $item_list = FIFO::getAvailableListStock($item->barang_id, $item->qty);

            FIFO::calculate_HPP($item->barang_id, $hpp->qty, UPDATE_MODE);
        endif;
    }
}




//?page=transaksi/form&time=1628123812&userID=1

$url = app_path() . '?page=transaksi/print' . '&id=' . $trx->id;;
header('Location:' . $url);
