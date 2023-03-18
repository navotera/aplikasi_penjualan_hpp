<?php
require_once './orm/PelangganORM.php';
$editMode = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $pelanggan_id = $_GET['id'];
    $pelanggan = PelangganORM::findOne($pelanggan_id);
    $editMode = $pelanggan;
}

?>

<div class="panel panel-default">
    <div class="panel-heading">Form Pelanggan</div>
    <div class="panel-body">

        <form class="form-horizontal col-md-6 col-md-offset-2" method="POST" action="<?= app_path(); ?>/pelanggan/save.php">

            <!-- Jika mode edit, maka siapkan id yang sudah ada -->
            <?php if ($editMode) : ?>
                <input type="hidden" name="id" value="<?= $pelanggan->id; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= ($editMode) ? $pelanggan->nama : '' ?>" name="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="form-group">
                <label for="telp" class="col-sm-2 control-label">Telp</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= ($editMode) ? $pelanggan->telp : '' ?>" name="telp" class="form-control" placeholder="Telepon pelanggan">
                </div>
            </div>

            <div class="form-group">
                <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= ($editMode) ? $pelanggan->alamat : '' ?>" name="alamat" class="form-control" id="alamat" placeholder="Alamat Lengkap Pelanggan">
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