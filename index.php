<?php
require_once 'Autoloader.php';
require_once 'constants.php';
require_once 'helper/function.php';
require_once 'section/header.php';
require_once 'section/sidebarmenu.php'; ?>


<?php

//ambil parameter halaman yang akan di load dari $_GET['page']
$page = (isset($_GET['page'])) ? $_GET['page'] : false; // ini disebut dengan tenary

// if(isset($_GET['page'])) {
//     $page = $_GET['page'];
// }
// else {
//     $page =  false;
// }

//apakah ada karakter / jika tidak ada maka load index.php saja
//http://localhost/aplikasi_penjualan/?page=pelanggan/form_tambah
$loadFile = (strpos($page, '/') !== false) ? $page . '.php' : $page . '/index.php';

?>


<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row" id="main">


            <?php
            //page is only index
            if (!$page) : ?>
                <div class="col-sm-12 col-md-12 well" id="content">
                    <h2><?= (isset($_SESSION['message'])) ? $_SESSION['message'] : ''; ?></h2>
                </div>
            <?php endif; ?>



            <!-- accessed not index but with page as parameter -->
            <?php
            //jika ada parameter $_GET['page'] dan ada file yang akan diload misalnya form_tambah.php sesuai dengan path : 
            //http://localhost/aplikasi_penjualan/?page=pelanggan/form_tambah 
            //maka jalankan require_once            
            if ($page && file_exists($loadFile)) {
                require_once $loadFile;
            } else {

                //jika file tidak ada maka tampikan alert file is not exist!
                echo ($page) ?  "<div class='alert alert-danger'> File " . $loadFile . ' is not exist </div>' : '';
            }

            ?>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div><!-- /#wrapper -->


<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(".side-nav .collapse").on("hide.bs.collapse", function() {
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
        });
        $('.side-nav .collapse').on("show.bs.collapse", function() {
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");
        });
    })
</script>




<script type="text/javascript">
    // Jquery Dependency
    $('.money').mask('000.000.000', {
        reverse: true
    });
</script>

<script>
    //format tanggal
    var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'D/M/YYYY',
        toString(date, format) {
            // you should do formatting based on the passed format,
            // but we will just return 'D/M/YYYY' for simplicity
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        },
        parse(dateString, format) {
            // dateString is the result of `toString` method
            const parts = dateString.split('/');
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);
            return new Date(year, month, day);
        }
    });
</script>