<?php

require_once './orm/TransaksiORM.php';
?>

<?php

//menentukan tujuan form berdasarkan jenis transaksi     
$jenis_trx = ($_GET['jenis'] == PEMBELIAN) ? 'pembelian' : 'penjualan';
$formTujuan = 'form_' . $jenis_trx;

?>

<div class="panel panel-default">
    <div class="panel-heading">


        Daftar Transaksi Terakhir <?= ucfirst($jenis_trx); ?>
        <?php
        if (isset($_SESSION['message'])) {
            echo ' <div class="text-info pull-right notice">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>
        <a class="pull-right btn btn-primary" href="<?= app_path(); ?>?page=transaksi/<?= $formTujuan; ?>&time=<?= time(); ?>&userID=<?= $_SESSION['UserID']; ?>&jenis=<?= $_GET['jenis']; ?>" role="button"><i class="fa fa-plus"></i> Tambah</a>

    </div>
    <div class="panel-body">





        <div class="col-12">
            <?php if ($jenis_trx == 'pembelian')
                include('list_pembelian_terakhir.php'); ?>


            <?php if ($jenis_trx == 'penjualan')
                include('list_penjualan_terakhir.php'); ?>


        </div>
    </div>
</div>