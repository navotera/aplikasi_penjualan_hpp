<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse sidebarmenu">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="<?= app_path(); ?>?page=pelanggan"><i class="fa fa-fw fa-user"></i> Pelanggan </a>
        </li>
        <li>
            <a href="<?= app_path(); ?>?page=barang"><i class="fa fa-fw fa-archive"></i> Barang </a>

        </li>
        <li>

            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#list_transaksi" aria-expanded="true" aria-controls="collapseOne">
                <i class="fa fa-fw fa-user-plus"></i> Transaksi
            </a>
            <div id="list_transaksi" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <ul>
                    <li><a href="<?= app_path(); ?>?page=transaksi&jenis=1"> Pembelian</a></li>
                    <li><a href="<?= app_path(); ?>?page=transaksi&jenis=2"> Penjualan</a></li>
                </ul>
            </div>

        </li>
        <li>
            <a href="sugerencias"><i class="fa fa-fw fa-paper-plane-o"></i> MENU 4</a>
        </li>
        <li>
            <a href="faq"><i class="fa fa-fw fa fa-question-circle"></i> MENU 5</a>
        </li>
    </ul>
</div>
<!-- /.navbar-collapse -->
</nav>