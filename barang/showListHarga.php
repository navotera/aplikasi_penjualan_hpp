<?php

$barang_id = (isset($_GET['id'])) ? $_GET['id'] : false;

//require_once './helper/function.php';
require_once  '../orm/HargaBarangORM.php';
require_once  '../orm/UserORM.php';

if (!$barang_id) {
    echo 'Barang tidak dipilih';
    exit;
}



?>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Pemasok</th>
            <th>Harga / Unit</th>
            <th>Diinput oleh</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <?php
        //get all pelanggan list 
        $list_harga = HargaBarangORM::where('barang_id', $barang_id)->order_by_desc('tanggal')->findMany();

        foreach ($list_harga as $key => $harga) :

            $patokanHargaIcon = ($key === 0) ? '✔️' : '';

        ?>


            <tr>
                <th scope="row"><?= $key + 1; ?></th>
                <td><?= format_tanggal_ID($harga->tanggal); ?></td>
                <td><?= $harga->pemasok  ?></td>
                <td><?= format_rupiah($harga->harga) . ' ' . $patokanHargaIcon;; ?></td>
                <td><?= UserORM::getName($harga->user_id); ?></td>
                <td>
                    <span style="font-size: 13px">
                        <a class="edit_harga" href="<?= app_path(); ?>/barang/edit_harga_ajax.php?id=<?= $harga->id; ?>">Edit &nbsp;</a>
                        <span style="color: #e4e4e4">|</span> &nbsp;
                        <a class="delete_harga text-danger" href="<?= app_path(); ?>?page=barang/delete_harga&id=<?= $harga->id; ?>">Delete</a>
                    </span>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

✔️ : Patokan harga untuk harga jual