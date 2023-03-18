<?php
require_once './orm/UserORM.php';
require_once './orm/TransaksiORM.php';
require_once './orm/TransaksiDetailORM.php';
require_once './orm/PelangganORM.php';
require_once './orm/BarangORM.php';
$id = $_GET['id']; //diambil dari url parameter get

$trx = TransaksiORM::findOne($id); //output adalah array
$rincian_transaksi = TransaksiDetailORM::where('transaksi_id', $trx->id)->order_by_asc('id')->findMany();


?>
<div class="panel panel-default">
    <div class="panel-heading">Detail Transaksi <span class="pull-right" style="color: grey; font-size:14px"> Operator : <?= UserORM::getName($_SESSION['UserID']); ?></span></div>
    <div class="panel-body">


        <div class="col-md-6 col-md-offset-2">

            <div class="row noprint" style="margin: 10px 0;">
                <div class="col-md-8 col-sm-8" style="padding: 0">
                    <a href="#" id="print" class="btn-sm btn btn-info">Print</a>
                </div>

                <div class="col-md-2 col-sm-2" style="padding: 0;text-align: right">
                    <a href="#" class="btn-sm btn btn-warning">Edit</a>
                </div>

                <div class="col-md-2 col-sm-2" style="padding: 0; text-align: right">
                    <a href="<?= app_path(); ?>?page=transaksi/form&time=<?= time(); ?>&userID=<?= $_SESSION['UserID']; ?>" class="btn-sm btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>

            <table class="table table-bordered" style="font-size: 0.8em;">
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?= format_tanggal_ID($trx->tanggal); ?></td>
                </tr>
                <tr>
                    <td>Kode Transaksi</td>
                    <td>:</td>
                    <td><?= $trx->kode; ?></td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td>:</td>
                    <td><?= PelangganORM::getNama($trx->pelanggan_id); ?></td>
                </tr>

            </table>



        </div>



        <div class="col-md-6 col-md-offset-2">
            <table class="table table-striped" style="font-size: 0.8em;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Unit</th>
                        <th>Harga / Unit</th>
                        <th>Total</th>

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

                        </tr>


                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4"><b>Grand Total :</b> </td>
                        <td colspan="3" style="color: #c74906"> <?= format_rupiah($total_transaksi); ?></td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $('#print').click(function(e) {
        e.preventDefault();
        window.print();
    })
</script>