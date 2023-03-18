<?php require_once './orm/PelangganORM.php'; ?>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Pelanggan
        <?php
        if (isset($_SESSION['message'])) {
            echo ' <div class="text-info pull-right notice">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

    </div>
    <div class="panel-body">

        <a class="pull-right btn btn-primary" href="<?= app_path(); ?>?page=pelanggan/form" role="button"><i class="fa fa-plus"></i> Tambah</a>

        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Telp</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //get all pelanggan list 
                    $list_pelanggan = PelangganORM::findMany();

                    foreach ($list_pelanggan as $key => $pelanggan) :  ?>

                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td><a href="<?= app_path(); ?>?page=pelanggan/detail&id=<?= $pelanggan->id; ?>"><?= $pelanggan->nama; ?></a></td>
                            <td><?= $pelanggan->telp; ?></td>
                            <td><?= $pelanggan->alamat; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>