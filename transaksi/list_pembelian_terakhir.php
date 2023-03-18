<?php

// sudah menggunakan autoloaderORM jadi tidak perlu lagi ini
// require_once './orm/TransaksiORM.php';
// require_once './orm/TransaksiDetailORM.php';
// require_once './orm/BarangORM.php';
// require_once './orm/UserORM.php';



$list = TransaksiORM::getLatest(PEMBELIAN);
//var_dump($list);

?>

<table class="table table-striped list_transaksi_terakhir">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode Transaksi</th>
            <th>Jumlah Barang</th>
            <th>Total Transaksi</th>
            <th>Tanggal</th>
            <th>By</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $key => $row) : ?>
            <tr>
                <td><?= $key + 1; ?></td>
                <td><a href="<?= app_path(); ?>?page=transaksi/print&id=<?= $row->id;  ?>"><?= $row->id; ?></a></td>
                <td><?= TransaksiORM::getTotalQty($row->id); ?></td>
                <td><?= format_rupiah(TransaksiORM::getTotal($row->id)); ?></td>
                <td><?= format_tanggal_ID($row->tanggal); ?></td>
                <td><?= UserORM::getName($row->user_id); ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>