<?php
require_once './constants.php';
require_once './orm/UserORM.php';
require_once './orm/TransaksiORM.php';
require_once './orm/PelangganORM.php';
require_once './orm/BarangORM.php';
require_once './orm/SupplierORM.php';
$id = isset($_GET['id']) ? $_GET['id'] : false; //diambil dari url parameter get



$trx = TransaksiORM::findOne($id); //output adalah array
$list_supplier = SupplierORM::findMany();
$list_pelanggan = PelangganORM::findMany();
$list_barang = BarangORM::order_by_asc('nama')->findMany();

$editMode = isset($id) && ($trx);

//cari kode transaksi terakhir
$kodeTrx = (!$editMode) ? TransaksiORM::max('kode') + 1 : $trx->kode;



?>
<div class="panel panel-default">
    <div class="panel-heading">Form Transaksi <?= ucfirst($_GET['type']); ?> <span class="pull-right" style="color: grey; font-size:14px"> Operator : <?= UserORM::getName($_SESSION['UserID']); ?></span></div>
    <div class="panel-body">

        <h3> Data Transaksi </h3>
        <form class="form-horizontal " id="form_transaksi" method="POST" action="<?= app_path(); ?>/transaksi/save.php">

            <div class="col-md-6 col-md-offset-2">
                <div class="form-group">
                    <label for="telp" class="col-sm-2 control-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="text" name="tanggal" class="form-control" id="datepicker" placeholder="Tgl" value="<?= (!$editMode) ? date('d-m-Y') : $trx->tanggal; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telp" class="col-sm-2 control-label">Kode Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode" class="form-control" placeholder="Tgl" readonly value="<?= $kodeTrx; ?>">
                    </div>
                </div>

                <?php if ($_GET['type'] == 'pembelian') : ?>
                    <!-- drop down ini untuk pembelian  -->
                    <div class="form-group">
                        <label for="telp" class="col-sm-2 control-label">Supplier</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="supplier_id">
                                <?php foreach ($list_supplier as $supplier) : ?>
                                    <option value="<?= $supplier->id; ?>"><?= $supplier->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                <?php endif; ?>


                <?php if ($_GET['type'] == 'penjualan') : ?>
                    <!-- drop down ini untuk penjualan  -->
                    <div class="form-group">
                        <label for="telp" class="col-sm-2 control-label">Pelanggan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="pelanggan_id">
                                <?php foreach ($list_pelanggan as $pelanggan) : ?>
                                    <option value="<?= $pelanggan->id; ?>"><?= $pelanggan->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                <?php endif; ?>

            </div>

            <!-- jika metode edit -->
            <input type="hidden" name="id" value="<?= $trx->id ?>">

            <!-- pembeda transaksi temporary -->
            <input type="hidden" name="time" value="<?= $_GET['time'] ?>">
            <input type="hidden" name="user_id" value="<?= $_GET['userID'] ?>">
            <input type="hidden" name="jenis" value="<?= $_GET['jenis'] ?>">




            <div class="row">
                <div class="col-md-12 clearfix">

                    <h3> Detail Barang
                        <a class="pull-right btn btn-xs btn-primary" href="#" role="button" data-toggle="modal" data-target="#modal-pembelian"><i class="fa fa-plus"></i> Tambah</a>
                    </h3>

                    <div id="list_detail"></div>

                </div>
            </div>
        </form>
    </div>
</div>





<!-- Modal Pembelian -->
<div class="modal fade" id="modal-pembelian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="tambah_barang" class="form-horizontal" style="inline-block">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Form Transaksi Detail </h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="trx_id" value="<?= $trx->id; ?>">
                    <input type="hidden" name="trx_detail_id">
                    <input type="hidden" name="jenis" value="<?= $_GET['jenis'] ?>">

                    <!-- pembeda transaksi temporary -->
                    <input type="hidden" name="time" value="<?= $_GET['time'] ?>">

                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Pilih Barang</label>
                        <div class="col-sm-9">
                            <select name="barang_id" class="form-control">
                                <option selected disabled>Pilih Barang</option>
                                <?php foreach ($list_barang as $barang) : ?>
                                    <option value="<?= $barang->id; ?>"><?= $barang->nama; ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Harga / Unit</label>
                        <div class="col-sm-9">
                            <input type="text" value="" name="harga_perunit" class="form-control money " placeholder="Harga / unit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Jumlah Unit</label>
                        <div class="col-sm-9">
                            <input type="text" value="" name="jumlah" class="form-control " placeholder="Jumlah unit" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telp" class="col-sm-3 control-label">Total (Rp.)</label>
                        <div class="col-sm-9">
                            <input type="text" value="" name="total" class="form-control " placeholder="Total Harga">
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
    function loadListTransaksiDetail() {

        <?php
        //tentukan apakah ini edit (id) atau transaksi baru (temporary_token)
        $identity = 'time=' . $_GET['time'] . '&user_id=' . $_GET['userID'];
        ?>

        //buat variable url di javascript
        var url = '<?= app_path(); ?>/transaksi/showListRincianTransaksiAjax.php?<?= $identity; ?>';

        $.get(url, function(data) {
            $("#list_detail").html(data);
        });
    }
    //tampilkan list harga dari ajax
    loadListTransaksiDetail();



    //hapus inputan form 
    function form_reset(formID) {
        $(formID).find('input:not(:hidden)').val('');
        $(formID).find("input[name=harga_id]").val('');
    }





    //fungsi mengambil data harga barang terakhir
    function getHargaBarang(barangID) {

        //buat variable url di 
        var url = '<?= app_path(); ?>/transaksi/getLastHargaBarangAjax.php?barangId=' + barangID;
        $.getJSON(url, function(data) {
            $("input[name=pemasok]").val(data.pemasok);
            $("input[name=harga_perunit]").val(data.harga);
        });
    }


    //menangkap event untuk perubahan nilai pada barang 
    $(document).on("change", "select[name=barang_id]", function(e) {
        let barang_id = $(this).val();
        getHargaBarang(barang_id);
    });


    $(document).on("input", "input[name=jumlah]", function(e) {
        harga = $('input[name=harga_perunit]').val().split('.').join("");
        jumlah = $(this).val();
        total = harga * jumlah;

        $('input[name=total]').val(formatRupiah(total));
    });

    let formModal = '#formDetailTrx';
    var formTambahBarang = '#tambah_barang';

    //handle penyimpanan barang dari form yang ada di modal
    $(formTambahBarang).on("submit", function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'post',
            url: '<?= app_path(); ?>/transaksi/saveTransaksiAjax.php',
            data: formData,
            success: function(result) {
                $(formModal).modal('hide');
                loadListTransaksiDetail();
                form_reset(formTambahBarang);
            }
        });
    });



    //tampilkan modal untuk bisa di edit
    $(document).on("click", ".edit_transaksi_detail", function(e) {
        e.preventDefault();

        let url = $(this).attr('href');
        $.getJSON(url, function(data) {
            $(formModal).modal('show');
            $("select[name=barang_id]").val(data.barang_id);
            $("input[name=harga]").val(data.harga);
            $("input[name=jumlah]").val(data.jumlah);
            $("input[name=total]").val(data.total);
            $("input[name=trx_detail_id]").val(data.trx_detail_id);

        });
    });



    function formatRupiah(number) {
        let format = number.toString().split('').reverse().join('');
        let convert = format.match(/\d{1,3}/g);
        return convert.join('.').split('').reverse().join('')
    }
</script>