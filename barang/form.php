<?php
require_once './orm/BarangORM.php';
$editMode = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $barang_id = $_GET['id'];
    $barang = BarangORM::findOne($barang_id); //jika tidak ditemukan maka nilainya adalah false, jika ditemukan maka akan ada value
    $editMode = $barang; //jika ada maka nilai $editMode bukanlah false
}

?>

<div class="panel panel-default">
    <div class="panel-heading">Form Barang</div>
    <div class="panel-body">

        <form class="form-horizontal col-md-6 col-md-offset-2" method="POST" action="<?= app_path(); ?>/barang/save.php">

            <!-- Jika mode edit, maka siapkan id yang sudah ada -->
            <?php if ($editMode) : ?>
                <input type="hidden" name="id" value="<?= $barang->id; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">Barcode</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= ($editMode) ? $barang->kode_barcode : '' ?>" name="kode_barcode" class="form-control" placeholder="Kode Barcode Barang">
                </div>
            </div>

            <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= ($editMode) ? $barang->nama : '' ?>" name="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">Pemasok</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= ($editMode) ? $barang->pemasok : '' ?>" name="pemasok" class="form-control" placeholder="Pemasok Barang">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>


    </div>

</div>