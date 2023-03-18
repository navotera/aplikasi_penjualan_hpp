<?php
require_once 'config.php';
class UserORM extends Model
{
    //nama tabel di database
    public static $_table = 'user';


    static function getName($id)
    {
        $user = self::findOne($id);
        return ($user) ? $user->nama : '';
    }
}
