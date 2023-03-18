<?php
require_once './orm/PelangganORM.php';
$id = $_GET['id']; //diambil dari url parameter get

$pelanggan = PelangganORM::findOne($id); //output adalah array

if (!$pelanggan) {
    echo 'data tidak ditemukan';
    return;
}

?>
<div class="panel panel-default">
    <div class="panel-heading">Detail Pelanggan</div>
    <div class="panel-body">



        <div class="col-md-4 col-sm-4">
            <div><b>Nama</b></div>
            <div> <?= $pelanggan->nama; ?> </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div><b>Telp</b></div>
            <div> <?= $pelanggan->telp; ?> </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div><b>Alamat</b></div>
            <div><?= $pelanggan->alamat; ?></div>
        </div>


        <div class="col-md-6 col-sm-12" style="margin-top: 40px">
            <div style="float:left; margin-right: 20px"><b><a href="<?= app_path(); ?>?page=pelanggan/form&id=<?= $id; ?>">Edit</a></b></div>
            <div div style="float:left"><b><a href="<?= app_path(); ?>?page=pelanggan/delete&id=<?= $id; ?>" style="color: red">Delete</a></b></div>
        </div>

    </div>
</div>