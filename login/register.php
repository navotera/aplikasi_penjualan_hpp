<?php

//initiate the session
session_start();

require_once '../orm/UserORM.php';


$post = (object) $_POST;

//check konfirmasi password pada input password vs input password_confirm
if ($post->password != $post->password_confirm) {
    $_SESSION['message'] = "Konfirmasi password salah";
    header('location:form_register.php');
    return;
}


$user = UserORM::create();
$user->nama = $post->nama;
$user->email = $post->email;
$user->password = password_hash($post->password, PASSWORD_DEFAULT);
$user->save();

$_SESSION['message'] = "Selamat anda berhasil terdaftar, selanjutnya silahkan login";

header('location:form_login.php');
