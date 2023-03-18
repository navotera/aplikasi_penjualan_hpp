<?php

session_start();

//require_once './helper/function.php';
require_once  '../orm/HargaBarangORM.php';


//konversi array jadi object dari $_POST['xx'] menjadi $post->xx;
$post = (object) $_POST;

//siapkan data (update atau simpan baru)
$harga = (isset($post->harga_id) && $post->harga_id != false) ? HargaBarangORM::findOne($post->harga_id) : HargaBarangORM::create();

//isi kolom dengan nilai dari form_tambah
$harga->harga = str_replace(".", "", $post->harga);
$harga->user_id = $_SESSION['UserID'];
$harga->pemasok = $post->pemasok;
$harga->tanggal = date("Y-m-d", strtotime($post->tanggal));
$harga->barang_id = $post->barang_id;

//simpan data
$harga->save();
