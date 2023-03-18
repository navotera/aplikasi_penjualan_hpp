<?php
//initiate the session
session_start();


if (isset($_SESSION['isLoggedIn'])) {

    unset($_SESSION['message']);
    unset($_SESSION['isLoggedIn']);
    unset($_SESSION['UserID']);

    //atau klo mau simple bisa juga dengan perintah berikut :  
    //$_SESSION = array();

    $_SESSION['message'] = 'You have logged out';

    header('location:form_login.php');
}
