<?php



require_once '../helper/function.php';
require_once  '../orm/TransaksiORM.php';
require_once  '../orm/TransaksiDetailORM.php';
require_once  '../orm/UserORM.php';
require_once  '../orm/BarangORM.php';

$get = (object) $_GET;
$user_id = $get->user_id;
$time = $get->time;


//get all pelanggan list 
$rincian_transaksi =  TransaksiDetailORM::where('user_id', $user_id)->where('time', $time)->order_by_asc('id')->findMany();
$total_transaksi = 0;


if (!$rincian_transaksi) {
    echo 'Barang Tidak ada';
    exit;
}

?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Jumlah Unit</th>
            <th>Harga / Unit</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php

        foreach ($rincian_transaksi as $key => $rincian) :

            $total_transaksi = $total_transaksi + $rincian->total;

        ?>

            <tr>
                <th scope="row"><?= $key + 1; ?></th>
                <td><?= BarangORM::getNama($rincian->barang_id); ?></td>
                <td><?= $rincian->qty; ?></td>
                <td><?= format_rupiah($rincian->harga); ?></td>
                <td><?= format_rupiah($rincian->harga * $rincian->qty) ?></td>
                <td>
                    <span style="font-size: 13px">
                        <a class="edit_transaksi_detail" href="<?= app_path(); ?>/transaksi/get_transaksi_detail.php?id=<?= $rincian->id; ?>">Edit &nbsp;</a>
                        <span style="color: #e4e4e4">|</span> &nbsp;
                        <a class="delete_harga text-danger" href="<?= app_path(); ?>/transaksi/delete_barang_ajax.php?id=<?= $rincian->id; ?>">Delete</a>
                    </span>
                </td>
            </tr>


        <?php endforeach; ?>
        <tr>
            <td colspan="4"><b>Grand Total :</b> </td>
            <td colspan="3" style="color: #c74906"> <?= format_rupiah($total_transaksi); ?></td>

        </tr>
    </tbody>
</table>


<button type="submit" id="simpan_transaksi" class="btn btn-warning pull-right">Simpan Transaksi</button>