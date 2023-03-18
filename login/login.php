<?php

//initiate the session
session_start();

require_once '../orm/UserORM.php';

$post = (object) $_POST;
$canLoggedIn = false;

//find user by email
$isUserExist = UserORM::where('email', $post->email)->findOne();

if (!$isUserExist) {
    $_SESSION['message'] = "User tidak ditemukan";
    header('location:form_login.php');
}

$canLoggedIn =  password_verify($post->password, $isUserExist->password);

if (!$canLoggedIn) {
    $_SESSION['message'] = "Anda tidak memiliki akses!";
    header('location:form_login.php');
    return;
}

//no problem with username and password, all is correct
$_SESSION['message'] = 'Hola ' . $isUserExist->nama;
$_SESSION['isLoggedIn'] = true;
$_SESSION['UserID'] = $isUserExist->id;
header('location:../index.php');
