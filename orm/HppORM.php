<?php
require_once 'config.php';
class HppORM extends Model
{
    //nama tabel di database
    public static $_table = 'hpp';


    public static function getLatest($jenis, $barang_id = false)
    {
        $query = self::_getMany($jenis)->order_by_desc('id');

        if ($barang_id) {
            $query->where('barang_id', $barang_id);
        }

        return $query->findMany();
    }

    public static function _getMany($jenis)
    {
        return self::where('jenis', $jenis);
    }

    public static function getList()
    {
        return self::order_by_desc('id')->findMany();
    }

    public static function qtyTersedia($barang_id)
    {
        return self::where('barang_id', $barang_id)->sum('sisa');
    }
}
