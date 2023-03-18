<?php
function format_rupiah($angka)
{
    $hasil_rupiah = "Rp. " . format_uang($angka);
    return $hasil_rupiah;
}


function format_uang($angka)
{
    $nilai = number_format($angka, 0, ',', '.');
    return $nilai;
}

function format_tanggal_ID($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function random_string($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function app_path()
{
    $completePath = explode('/', $_SERVER['PHP_SELF']);
    $base = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $completePath[1];
    return rtrim($base, '/');
}

function app_dir()
{
    $root = $_SERVER['DOCUMENT_ROOT'];
    $completePath = explode('/', $_SERVER['PHP_SELF']);
    return $root . '/' . $completePath[1];
}
