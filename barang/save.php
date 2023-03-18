<?php

session_start();

//require_once './helper/function.php';
require_once  '../orm/BarangORM.php';


//konversi array jadi object dari $_POST['xx'] menjadi $post->xx;
$post = (object) $_POST;

//siapkan data (update atau simpan baru)
$barang = (isset($post->id)) ? BarangORM::findOne($post->id) : BarangORM::create();

//isi kolom dengan nilai dari form_tambah
$barang->nama = $post->nama;
$barang->kode_barcode = $post->kode_barcode;
$barang->pemasok = $post->pemasok;

//simpan data
$barang->save();

$_SESSION['message'] =  "Saving is successful 🐣";

$url = app_path() . '?page=barang';
header('Location:' . $url);
