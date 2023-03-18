<?php
require_once 'config.php';
require_once 'TransaksiDetailORM.php';
class TransaksiORM extends Model
{
    //nama tabel di database
    public static $_table = 'transaksi';

    public static function getColumn($column, $transaksi_id)
    {
        return self::where('id', $transaksi_id)->findOne()->$column;
    }

    public static function getLatest($jenis)
    {
        return self::where('jenis', $jenis)->order_by_desc('id')->findMany();
    }

    public static function getTotal($trx_id)
    {
        $list_detail = self::getTrxDetail($trx_id)->findMany();
        $total = 0;
        foreach ($list_detail as $row) {
            $total += $row->harga * $row->qty;
        }

        return $total;
    }

    public static function getTotalQty($trx_id)
    {
        $total =   self::getTrxDetail($trx_id)->sum('qty');
        return $total;
    }


    public static function getTrxDetail($trx_id)
    {
        return TransaksiDetailORM::where('transaksi_id', $trx_id)->where('status_temporary', 0);
    }
}
