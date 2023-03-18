<?php require_once './orm/BarangORM.php'; ?>

<div class="panel panel-default">
    <div class="panel-heading">
        Daftar Barang
        <?php
        if (isset($_SESSION['message'])) {
            echo ' <div class="text-info pull-right notice">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

    </div>
    <div class="panel-body">

        <a class="pull-right btn btn-primary" href="<?= app_path(); ?>?page=barang/form" role="button"><i class="fa fa-plus"></i> Tambah</a>

        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Pemasok</th>
                        <th>Kuantitas</th>
                        <th>Harga / Unit</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    //get all pelanggan list 
                    $list_barang = BarangORM::findMany();

                    foreach ($list_barang as $key => $barang) :  ?>

                        <tr>
                            <th scope="row"><?= $key + 1; ?></th>
                            <td><a href="<?= app_path(); ?>?page=barang/detail&id=<?= $barang->id; ?>"><?= $barang->nama; ?></a></td>
                            <td><?= $barang->pemasok; ?></td>
                            <td><?= $barang->qty; ?></td>
                            <td><?= $barang->harga; ?></td>
                            <td><?= $barang->tanggal; ?></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>