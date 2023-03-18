<?php
require_once 'config.php';
class TransaksiDetailORM extends Model
{
    //nama tabel di database
    public static $_table = 'transaksi_detail';

    public static function getLatest($jenis, $barang_id = false)
    {
        $query = self::_getMany()->where('jenis', $jenis)->order_by_desc('id');

        if ($barang_id) {
            $query->where('barang_id', $barang_id);
        }

        return $query->findMany();
    }

    public static function _getMany()
    {
        return self::where('status_temporary', 0);
    }
}
