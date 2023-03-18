<?php

session_start();

//require_once './helper/function.php';
require_once  '../orm/PelangganORM.php';


//konversi array jadi object dari $_POST['xx'] menjadi $post->xx;
$post = (object) $_POST;

//siapkan data (update atau simpan baru)
$pelanggan = (isset($post->id)) ? PelangganORM::findOne($post->id) : PelangganORM::create();

//isi kolom dengan nilai dari form_tambah
$pelanggan->nama = $post->nama;
$pelanggan->telp = $post->telp;
$pelanggan->alamat = $post->alamat;

//simpan data
$pelanggan->save();

$_SESSION['message'] =  "Saving is successful 🐣";

$url = app_path() . '?page=pelanggan';
header('Location:' . $url);
