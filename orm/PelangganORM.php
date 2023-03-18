<?php
require_once 'config.php';
class PelangganORM extends Model
{
    //nama tabel di database
    public static $_table = 'pelanggan';

    public static function getNama($id)
    {
        $pelanggan = self::findOne($id);

        return ($pelanggan) ? $pelanggan->nama : '';
    }
}
