<?php
// require_once '../orm/HppORM.php';
require_once '../constants.php';

class FIFO
{

    public static function calculate_HPP($barang_id, $jumlah_jual, $update_mode = false,  $j = 1)
    {
        $item_list = self::getAvailableListStock($barang_id);


        $jumlah_item_array = count($item_list['id']) + 1;
        $FIFO = array();
        for ($i = $j; $i <= $jumlah_item_array; $i++) {

            $FIFO['qty_jual'][$i] = self::baseStock($jumlah_jual, $item_list['sisa'][$i]);

            $jumlah_jual = (int)$jumlah_jual - $item_list['sisa'][$i];

            $FIFO['id'][$i] = $item_list['id'][$i];
            $FIFO['harga_beli'][$i] = $item_list['harga'][$i];
            $FIFO['hpp'][$i] =   $FIFO['qty_jual'][$i] * $item_list['harga'][$i];
            $FIFO['jumlah_jual'][$i] = $jumlah_jual;

            $FIFO['item_list'][$i] =  $jumlah_item_array;

            //update dilakukan pada saat proses penyimpanan seluruh transaksi dilakukan
            //jika proses pengisian transaksi awal maka secara default tidak diupdate
            if ($update_mode) :
                self::updateHPPById($item_list['id'][$i], $jumlah_jual);
            endif;



            if ($jumlah_jual <= 0) {
                //operasi tambah karena jumlah jual nilainya minus
                $FIFO['hpp'][$i] = ($item_list['sisa'][$i] + $jumlah_jual) * $item_list['harga'][$i];
            }

            if ($jumlah_jual <= 0) {
                break;
            } else {
                self::calculate_HPP($jumlah_jual, $item_list, $update_mode, $i + 1);
            }
        }
        return $FIFO;
    }



    public static function getAvailableListStock($barang_id)
    {

        $hpp_list = HppORM::where('barang_id', $barang_id)->where_not_equal('sisa', '0')->where('jenis', PEMBELIAN)->order_by_asc('id')->findMany();
        $i = 1;
        foreach ($hpp_list as $hpp) {
            $item['id'][$i] = $hpp->id;
            $item['qty'][$i] = $hpp->qty;
            $item['harga'][$i] = $hpp->harga;
            $item['sisa'][$i] = $hpp->sisa;

            $i++;
        }
        // echo ORM::get_last_query();
        return $item;
    }

    public static function echo()
    {
        echo 'asfaf';
    }


    public static function baseStock($jumlah_jual, $available_qty): ?int
    {
        if ($available_qty > $jumlah_jual) {
            $stok_digunakan = $jumlah_jual - $available_qty;
        }

        if ($jumlah_jual >= $available_qty) {
            $stok_digunakan =  $available_qty;
        }

        if ($stok_digunakan < 0) {
            $stok_digunakan = $available_qty + $stok_digunakan;
        }

        return $stok_digunakan;
    }


    public static function updateHPPById($hpp_id, $jumlah_jual)
    {
        //save the qty here

        $hpp = HppORM::findOne($hpp_id);
        $hpp->sisa = $jumlah_jual;
        $hpp->save();
    }
}
