<?php
require_once 'config.php';
class BarangORM extends Model
{
    //nama tabel di database
    public static $_table = 'barang';

    static function getNama($id)
    {
        $barang = self::findOne($id);
        return ($barang) ? $barang->nama : '';
    }
}
