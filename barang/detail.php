<?php


$id = $_GET['id']; //diambil dari url parameter get

$barang = BarangORM::findOne($id); //output adalah array

if (!$barang) {
    echo 'data tidak ditemukan';
    return;
}

$stokTersedia = HppORM::qtyTersedia($id);


// $item_list = FIFO::getAvailableListStock($barang->id);
$fifo = FIFO::calculate_HPP($barang->id, $stokTersedia);

$hpp_all = array_sum($fifo['hpp']);

?>
<div class="panel panel-default">
    <div class="panel-heading">Detail barang</div>
    <div class="panel-body">

        <h3> Info Barang

            <span class="pull-right" style="font-size: 12px">
                <div style="float:left; margin-right: 20px"><b><a href="<?= app_path(); ?>?page=barang/form&id=<?= $id; ?>">Edit</a></b></div>
                <div div style="float:left"><b><a href="<?= app_path(); ?>?page=barang/delete&id=<?= $id; ?>" style="color: red">Delete</a></b></div>
            </span>

        </h3>
        <div class="col-md-3 col-sm-3">
            <div><b>Nama</b></div>
            <div> <?= $barang->nama; ?> </div>
        </div>
        <div class="col-md-3 col-sm-3">
            <div><b>Kode Barcode</b></div>
            <div> <?= $barang->kode_barcode; ?> </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div><b>Pemasok</b></div>
            <div> <?= $barang->pemasok; ?> </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div><b>Kuantitas Tersedia</b></div>
            <div><?= $stokTersedia ?></div>
        </div>

        <div class="col-md-2 col-sm-2">
            <div><b>Harga Pokok Penjualan </b></div>
            <div><?= ($stokTersedia) ? format_rupiah($hpp_all / $stokTersedia) : 0 ?></div>
        </div>



        <div class="row">
            <div class="col-md-12 clearfix" style="margin-top: 50px">

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#list_pembelian" aria-controls="home" role="tab" data-toggle="tab">Pembelian</a></li>
                    <li role="presentation"><a href="#list_penjualan" aria-controls="profile" role="tab" data-toggle="tab">Penjualan</a></li>
                    <li role="presentation"><a href="#list_kartu_persediaan" aria-controls="messages" role="tab" data-toggle="tab">Kartu Persediaan</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="padding: 10px">
                    <div role="tabpanel" class="tab-pane active" id="list_pembelian">

                        <div class="col-md-12" style="margin: 10px 0">
                            <a class="pull-right btn btn-xs btn-primary" href="#" role="button" data-toggle="modal" data-target="#formHarga"><i class="fa fa-plus"></i> Tambah</a>
                        </div>



                        <?php $list = TransaksiDetailORM::getLatest(PEMBELIAN, $id); ?>

                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Qty</th>
                                <th>Harga/Unit</th>
                                <th>Total Beli</th>
                                <th>Supplier</th>
                                <th>Inputted By</th>
                            </tr>




                            <?php foreach ($list as $key => $row) :
                                $transaksi = TransaksiORM::findOne($row->transaksi_id);

                            ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= format_tanggal_ID($transaksi->tanggal); ?></td>
                                    <td><?= $row->qty; ?> </td>
                                    <td><?= format_rupiah($row->harga); ?></td>
                                    <td><?= format_rupiah($row->qty * $row->harga); ?></td>
                                    <td><?= SupplierORM::getNama($transaksi->supplier_id); ?></td>
                                    <td><?= UserORM::getName($transaksi->user_id); ?></td>
                                </tr>


                            <?php endforeach; ?>

                        </table>




                    </div>
                    <div role="tabpanel" class="tab-pane" id="list_penjualan">

                        <?php $list = HppORM::getLatest(PENJUALAN, $id); ?>

                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Qty</th>
                                <th>HPP Harga/Unit</th>
                                <th>Total </th>
                                <th>Pelanggan</th>
                                <th>Inputted By</th>
                            </tr>




                            <?php foreach ($list as $key => $row) :
                                $transaksi = TransaksiORM::findOne($row->transaksi_id);

                            ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= format_tanggal_ID($transaksi->tanggal); ?></td>
                                    <td><?= $row->qty; ?> </td>
                                    <td><?= format_rupiah($row->harga); ?></td>
                                    <td><?= format_rupiah($row->qty * $row->harga); ?></td>
                                    <td><?= PelangganORM::getNama($transaksi->pelanggan_id); ?></td>
                                    <td><?= UserORM::getName($transaksi->user_id); ?></td>
                                </tr>


                            <?php endforeach; ?>

                        </table>


                    </div>
                    <div role="tabpanel" class="tab-pane" id="list_kartu_persediaan">

                        <?php $list = HppORM::getList(); ?>

                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Qty</th>
                                <th>Sisa</th>
                                <th>HPP Harga/Unit</th>
                                <th>Total </th>
                                <th>Inputted By</th>
                            </tr>




                            <?php foreach ($list as $key => $row) :
                                $transaksi = TransaksiORM::findOne($row->transaksi_id);

                            ?>
                                <tr class="border border-<?= ($row->jenis == PEMBELIAN) ? "warning" : "success"; ?>">
                                    <td><?= $key + 1; ?></td>
                                    <td>
                                        <?= ($row->jenis == PEMBELIAN) ? '<span class="text-warning">Pembelian</span>' : '<span class="text-success">Penjualan</span>'; ?>
                                    </td>
                                    <td><?= format_tanggal_ID($transaksi->tanggal); ?></td>
                                    <td><?= $row->qty; ?> </td>
                                    <td><?= $row->sisa; ?> </td>
                                    <td><?= format_rupiah($row->harga); ?></td>
                                    <td><?= format_rupiah($row->qty * $row->harga); ?></td>
                                    <td><?= UserORM::getName($transaksi->user_id); ?></td>
                                </tr>


                            <?php endforeach; ?>

                        </table>

                    </div>
                </div>


            </div>




        </div>

    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="formHarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="harga_barang" class="form-horizontal" style="inline-block">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Form Harga</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="barang_id" id="barang_id" value="<?= $barang->id; ?>">
                    <input type="hidden" name="harga_id">

                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="text" name="tanggal" id="datepicker" class="form-control" placeholder="Tanggal Bayar">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Pemasok</label>
                        <div class="col-sm-9">
                            <input type="text" value="" name="pemasok" class="form-control" placeholder="Nama pemasok">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Harga / Unit</label>
                        <div class="col-sm-9">
                            <input type="text" value="" name="harga" class="form-control money" placeholder="Harga barang per unit">
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>

</div>



<script>
    //javascriptnya kita gunakan jquery
    // function loadListHarga() {
    //     var url = '<?= app_path(); ?>/barang/showListHarga.php?id=<?= $barang->id; ?>';
    //     $.get(url, function(response) {
    //         $("#list_harga").html(response);
    //     });
    // }


    //tampilkan list harga dari ajax
    // loadListHarga();


    let formModal = '#formHarga';
    var form_harga = '#harga_barang';

    $(form_harga).on("submit", function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'post', //atau bisa juga ditulis 'get' jika ingin metode pengiriman dengan get
            url: '<?= app_path(); ?>/barang/save_harga.php',
            data: formData,
            success: function(result) {
                $(formModal).modal('hide');
                loadListHarga();
                form_reset(form_harga);
            }
        });
    });



    //hapus inputan form 
    function form_reset(formID) {
        $('input:not(:hidden)').val('');
        $("input[name=harga_id]").val('');
    }





    //tampilkan modal untuk bisa di edit
    $(document).on("click", ".edit_harga", function(e) {
        e.preventDefault();

        let url = $(this).attr('href');
        $.getJSON(url, function(data) {
            $(formModal).modal('show');

            /**
             * contoh output : 
             *  error: ""
                harga: "200.001"
                harga_id: "5"
                pemasok: "DEPO Gemilang"
                tanggal: "10-07-2021"
             */



            $("input[name=tanggal]").val(data.tanggal);
            $("input[name=harga]").val(data.harga);
            $("input[name=pemasok]").val(data.pemasok);
            $("input[name=harga_id]").val(data.harga_id);

        });
    });
</script>