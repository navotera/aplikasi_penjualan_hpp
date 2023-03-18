<?php
require_once 'config.php';
class SupplierORM extends Model
{
    //nama tabel di database
    public static $_table = 'supplier';

    public static function getNama($id)
    {
        $supplier = self::findOne($id);

        return ($supplier) ? $supplier->nama : '';
    }
}
