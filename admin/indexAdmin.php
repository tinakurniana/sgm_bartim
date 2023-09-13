<?php
// mematikan semua error reporting
// error_reporting(0);

// mengkonekkan ke file function
include '../function-show.php';
include '../function-setting-profil.php';

// memulai eksekusi session (mengaktifkan session)
session_start();

// untuk mengambil sekarang ada di page mana
$pages_dir = 'pages-admin';
$pages = scandir($pages_dir, 0);
unset($pages[0], $pages[1]);
$p = isset($_GET['p']) ? $_GET['p'] : 'beranda';

// jika tidak ada session login admin maka diarahkan ke halaman login
if (!isset($_SESSION['loginAdmin'])) {
    header("Location: ../login.php");
}

//menangkap id admin yang sedang login
$id = $_SESSION['idAdmin'];

//query mengambil data admin dari database
$dataAdmin = tampilData("SELECT * FROM admin WHERE id_admin = $id");

//query megnambil data tahun dari database
$data_tahun = tampilData("SELECT tahun.tahun FROM tahun ORDER BY tahun.tahun ASC;");

//lalu data tahun yang ada dimasukkan kedalam array
foreach ($data_tahun as $dt) {
    $data_arr_tahun[] = $dt['tahun'];
}

//query megnambil data anggota dari database
$data_anggota = tampilData("SELECT
                                COUNT(anggota.id_anggota) AS anggota,
                                tahun.tahun
                            FROM
                                anggota
                            RIGHT JOIN tahun ON tahun.id = anggota.id_tahun
                            GROUP BY
                                tahun.tahun
                            ORDER BY tahun.tahun ASC;");

//lalu data anggota yang ada dimasukkan kedalam array
foreach ($data_anggota as $da) {
    $data_arr_anggota[] = $da['anggota'];
}

//query megnambil data hektar dari database
$data_hektar = tampilData("SELECT
                                SUM(anggota.luas_plasma) AS hektar,
                                tahun.tahun
                            FROM
                                anggota
                            RIGHT JOIN tahun ON tahun.id = anggota.id_tahun
                            GROUP BY
                                tahun.tahun
                            ORDER BY tahun.tahun ASC;");

//lalu data hektar yang ada dimasukkan kedalam array
foreach ($data_hektar as $dh) {
    $data_arr_hektar[] = $dh['hektar'];
}

$data_sw = tampilData("SELECT
                                SUM(simpanan_wajib.simpanan_wajib) AS total_wajib,
                                tahun.tahun
                            FROM
                                simpanan_wajib
                            RIGHT JOIN tahun ON simpanan_wajib.id_tahun = tahun.id
                            GROUP BY
                                tahun.tahun
                            ORDER BY
                                tahun.tahun ASC;");

foreach ($data_sw as $dsw) {
    $data_arr_sw[] = $dsw['total_wajib'];
}

$data_sp = tampilData("SELECT
                            SUM(simpanan_pokok.simpanan) AS total_pokok,
                            tahun.tahun
                        FROM
                            simpanan_pokok
                        RIGHT JOIN anggota ON simpanan_pokok.id_anggota = anggota.id_anggota
                        RIGHT JOIN tahun ON tahun.id = anggota.id_tahun
                        GROUP BY
                            tahun.tahun
                        ORDER BY
                            tahun.tahun ASC;");

foreach ($data_sp as $dsp) {
    $data_arr_sp[] = $dsp['total_pokok'];
}


if (isset($_POST['reset'])) {
    resetPassword($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />

    <title>Admin | Sistem Informasi Koperasi Plasma PT Sawit Graha Manunggal</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="Sistem Informasi Koperasi Plasma PT Sawit Graha Manunggal" />
    <meta name="author" content="PT Sawit Graha Manunggal" />

    <meta name="description" content="top menu &amp; navigation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- favicon -->
    <link rel="shortcut icon" href="assets-admin/img/favicon.png">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" type="text/css" href="assets-admin/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets-admin/plugins/font-awesome-4.6.3/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" type="text/css" href="assets-admin/plugins/chosen/css/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="assets-admin/plugins/datepicker/css/datepicker.min.css" />

    <!--fonts-->
    <link rel="stylesheet" type="text/css" href="assets-admin/fonts/fonts.googleapis.com.css" />

    <!--ace styles-->
    <link rel="stylesheet" type="text/css" href="assets-admin/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" type="text/css" href="assets-admin/js/ace-extra.min.js" />

    <!-- Fungsi untuk membatasi karakter yang diinputkan -->
    <script language="javascript">
        function getkey(e) {
            if (window.event)
                return window.event.keyCode;
            else if (e)
                return e.which;
            else
                return null;
        }

        function goodchars(e, goods, field) {
            var key, keychar;
            key = getkey(e);
            if (key == null) return true;

            keychar = String.fromCharCode(key);
            keychar = keychar.toLowerCase();
            goods = goods.toLowerCase();

            // check goodkeys
            if (goods.indexOf(keychar) != -1)
                return true;
            // control keys
            if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
                return true;

            if (key == 13) {
                var i;
                for (i = 0; i < field.form.elements.length; i++)
                    if (field == field.form.elements[i])
                        break;
                i = (i + 1) % field.form.elements.length;
                field.form.elements[i].focus();
                return false;
            };
            // else return false
            return false;
        }
    </script>

    <script type="text/javascript">
        function radio_option() {
            var val = 0;
            for (i = 0; i < document.frmFilter.filter.length; i++) {
                if (document.frmFilter.filter[i].checked == true) {
                    val = document.frmFilter.filter[i].value;
                    if (val == 'bulan') {
                        document.frmFilter.bulan.disabled = false;
                        document.frmFilter.tahun1.disabled = false;
                        document.frmFilter.tahun2.disabled = true;
                    } else if (val == 'tahun') {
                        document.frmFilter.bulan.disabled = true;
                        document.frmFilter.tahun1.disabled = true;
                        document.frmFilter.tahun2.disabled = false;
                    }
                }
            }
        }
    </script>

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar navbar-fixed-top">
        <div class="navbar-container" id="navbar-container">
            <div class="navbar-header pull-left">
                <a href="index.html" class="navbar-brand">
                    <small>
                        PT Sawit Graha Manunggal
                    </small>
                </a>

                <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
                    <span class="sr-only">Toggle user menu</span>
                </button>

                <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
                <ul class="nav ace-nav">
                    <li class="light-blue">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <i class="ace-icon fa fa-user"></i>
                            <span class="user-info">
                                Admin
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a data-toggle="modal" href="#ubah-password">
                                    <i class="ace-icon fa fa-lock"></i>
                                    Setting Account
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="../logout.php">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container" id="main-container">
        <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse sidebar-fixed">

            <ul class="nav nav-list">
                <li class="hover <?= $p === 'beranda' ? 'active' : '' ?>">
                    <a href="indexAdmin.php?p=beranda&m=beranda">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="menu-text"> Beranda </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover <?= $p === 'kelola-tahun' ? 'active' : '' ?>">
                    <a href="indexAdmin.php?p=kelola-tahun&m=kelola-tahun">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> Data Tahun </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover <?= $p === 'kelola-pengurus' ? 'active' : '' ?>">
                    <a href="indexAdmin.php?p=kelola-pengurus&m=pengurus">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> Data Pengurus </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover <?= $p === 'kelola-anggota' ? 'active' : '' ?>">
                    <a href="indexAdmin.php?p=kelola-anggota&m=anggota">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text"> Data Anggota </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover <?= $p === 'kelola-simpanan-pokok' || $p === 'kelola-simpanan-wajib' || $m === 'simpanan-pokok' || $m == 'simpanan-wajib-tahun' || $m == 'simpanan-wajib-bulan' || $m == 'simpanan-wajib' ? 'active' : '' ?>">
                    <a class="dropdown-toggle" href="#">
                        <i class="menu-icon fa fa-file-o"></i>
                        <span class="menu-text"> Data Simpanan </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="hover <?= $m === 'simpanan-pokok' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=kelola-simpanan-pokok&m=simpanan-pokok">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Simpanan Pokok
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover <?= $m === 'simpanan-wajib-tahun' || $m == 'simpanan-wajib-bulan' || $m == 'simpanan-wajib' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib-tahun">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Simpanan Wajib
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

                <li class="hover <?= $p === 'kelola-pembagian-hasil' ? 'active' : '' ?>">
                    <a href="indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil-tahun">
                        <i class="menu-icon fa fa-list"></i>
                        <span class="menu-text"> Pembagian Hasil Produksi </span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="hover <?= $p === 'monitoring-grafik' || $m === 'grafik-anggota-per-tahun' || $m === 'grafik-hektar-per-tahun' || $m === 'grafik-simpanan-per-tahun' ? 'active' : '' ?>">
                    <a class="dropdown-toggle" href="#">
                        <i class="menu-icon fa fa-bar-chart"></i>
                        <span class="menu-text">Monitoring Grafik </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="hover <?= $m === 'grafik-anggota-per-tahun' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=monitoring-grafik&m=grafik-anggota-per-tahun">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Grafik Anggota Pertahun
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="hover <?= $m === 'grafik-hektar-per-tahun' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=monitoring-grafik&m=grafik-hektar-per-tahun">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Grafik Hektar Pertahun
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="hover <?= $m === 'grafik-simpanan-per-tahun' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=monitoring-grafik&m=grafik-simpanan-per-tahun">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Grafik Simpanan Pertahun
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>


                <li class="hover <?= $p === 'kelola-profil-pt' || $p === 'kelola-galeri' || $p === 'kelola-kontak' ? 'active' : '' ?>">
                    <a class="dropdown-toggle" href="#">
                        <i class="menu-icon fa fa-desktop"></i>
                        <span class="menu-text"> Halaman Pengunjung </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="hover <?= $p === 'kelola-profil-pt' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=kelola-profil-pt&m=profil">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Kelola Profil PT Sawit Graha Manunggal
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover <?= $p === 'kelola-galeri' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=kelola-galeri&m=galeri">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Kelola Galeri
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="hover <?= $p === 'kelola-kontak' ? 'active' : '' ?>">
                            <a href="indexAdmin.php?p=kelola-kontak&m=kontak">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Kelola Kontak
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>

            </ul><!-- /.nav-list -->

        </div>

        <div class="main-content">
            <div class="main-content-inner">

                <!-- Untuk mengatur url pages -->
                <?php
                $pages_dir = 'pages-admin/' . $p;
                if (!empty($_GET['p']) && !empty($_GET['m'])) {
                    $pages = scandir($pages_dir, 0);
                    unset($pages[0], $pages[1]);
                    $p = $_GET['p'];
                    $m = $_GET['m'];
                    // print_r($pages_dir . '/' . $m . '.php');
                    // die;
                    if (in_array($m . '.php', $pages)) {
                        include($pages_dir . '/' . $m . '.php');
                    } else {
                        echo 'Halaman Tidak Ditemukan';
                    }
                } else {
                    include($pages_dir . '/beranda.php');
                }
                ?>

                <!-- Modal Ubah Passsword -->
                <div class="modal fade" id="ubah-password">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Form Setting Account</i></h4>
                                </div>
                                <div class="modal-body">
                                    <div id="login-box" class="login-box visible widget-box no-border">
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form action="" method="POST">
                                                    <fieldset>
                                                        <label class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $dataAdmin[0]['username'] ?>" autocomplete="off" required />
                                                                <i class="ace-icon fa fa-user"></i>
                                                            </span>
                                                        </label>

                                                        <label class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input type="password" class="form-control" name="password" placeholder="New Password" autocomplete="off" required />
                                                                <i class="ace-icon fa fa-lock"></i>
                                                            </span>
                                                        </label>

                                                        <div class="space"></div>

                                                        <div class="clearfix">
                                                            <input type="hidden" name="role" value="admin">
                                                            <button style="font-size:15px" name="reset" value="<?= $id ?>" type="submit" class="btn btn-primary btn-block">
                                                                <i class="ace-icon fa fa-key"></i>
                                                                <span class="bigger-110">Reset Account</span>
                                                            </button>
                                                        </div>

                                                        <div class="space-4"></div>
                                                    </fieldset>
                                                </form>
                                            </div><!-- /.widget-main -->
                                        </div><!-- /.widget-body -->
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- End Modal Ubah assword -->

            </div>
        </div><!-- /.main-content -->

        <!-- Footer -->
        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        &copy; 2023 - PT Sawit Graha Manunggal
                    </span>
                </div>
            </div>
        </div>
        <!-- End Footer -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="assets-admin/js/jquery.2.1.1.min.js"></script>
    <!-- <![endif]-->

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='assets-admin/js/jquery.min.js'>" + "<" + "/script>");
    </script>
    <!-- <![endif]-->

    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='assets-admin/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>

    <script src="assets-admin/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script src="assets-admin/plugins/chosen/js/chosen.jquery.min.js"></script>
    <script src="assets-admin/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets-admin/js/jquery.maskedinput.min.js"></script>

    <script src="assets-admin/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="assets-admin/plugins/dataTables/jquery.dataTables.bootstrap.min.js"></script>

    <!-- ace scripts -->
    <script src="assets-admin/js/ace-elements.min.js"></script>
    <script src="assets-admin/js/ace.min.js"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            if (!ace.vars['touch']) {
                // chosen select
                $('.chosen-select').chosen({
                    allow_single_deselect: true
                });
                //resize the chosen on window resize

                $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                            var $this = $(this);
                            $this.next().css({
                                'width': $this.parent().width()
                            });
                        })
                    }).trigger('resize.chosen');
                //resize chosen on sidebar collapse/expand
                $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                    if (event_name != 'sidebar_collapsed') return;
                    $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({
                            'width': $this.parent().width()
                        });
                    })
                });


                $('#chosen-multiple-style .btn').on('click', function(e) {
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
                    else $('#form-field-select-4').removeClass('tag-input-style');
                });
            }

            // tooltip
            $('[data-rel=tooltip]').tooltip();

            // input mask
            $('.input-mask-pukul').mask('99:99');

            // datepicker plugin
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            })

            // initiate dataTables plugin
            var oTable1 =
                $('#dynamic-table, #dynamic-table2')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aaSorting": [
                        [0, "asc"]
                    ],

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                });

            $('#data-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aaSorting": [
                        [0, "asc"]
                    ],

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    "sScrollX": "100%",
                    "sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                });
            //oTable1.fnAdjustColumnSizing();

            $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                no_file: 'Tidak ada file ...',
                btn_choose: 'Browse',
                btn_change: 'Change',
                droppable: false,
                onchange: null,
                thumbnail: false, //| true | large
                whitelist: 'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
            });
            //pre-show a file name, for example a previously selected file
            //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])

            $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                //if($(e.target).attr('href') == "#home") doSomethingNow();
            })

            var $sidebar = $('.sidebar').eq(0);
            if (!$sidebar.hasClass('h-sidebar')) return;

            $(document).on('settings.ace.top_menu', function(ev, event_name, fixed) {
                if (event_name !== 'sidebar_fixed') return;

                var sidebar = $sidebar.get(0);
                var $window = $(window);

                //return if sidebar is not fixed or in mobile view mode
                var sidebar_vars = $sidebar.ace_sidebar('vars');
                if (!fixed || (sidebar_vars['mobile_view'] || sidebar_vars['collapsible'])) {
                    $sidebar.removeClass('lower-highlight');
                    //restore original, default marginTop
                    sidebar.style.marginTop = '';

                    $window.off('scroll.ace.top_menu')
                    return;
                }


                var done = false;
                $window.on('scroll.ace.top_menu', function(e) {

                    var scroll = $window.scrollTop();
                    scroll = parseInt(scroll / 4); //move the menu up 1px for every 4px of document scrolling
                    if (scroll > 2) scroll = 2;


                    if (scroll > 1) {
                        if (!done) {
                            $sidebar.addClass('lower-highlight');
                            done = true;
                        }
                    } else {
                        if (done) {
                            $sidebar.removeClass('lower-highlight');
                            done = false;
                        }
                    }

                    sidebar.style['marginTop'] = (2 - scroll) + 'px';
                }).triggerHandler('scroll.ace.top_menu');

            }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed', $sidebar.hasClass('sidebar-fixed')]);

            $(window).on('resize.ace.top_menu', function() {
                $(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed', $sidebar.hasClass('sidebar-fixed')]);
            });
        });
    </script>


    <!-- GRAFIKK -->
    <!-- LIBRARY CHART JS buat GRAFIK -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- //grafik 1 (Data ANggota per tahun) -->
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo (json_encode($data_arr_tahun)); ?>,
                datasets: [{
                    label: 'Jumlah Anggota',
                    data: <?php echo (json_encode($data_arr_anggota)); ?>,
                    borderWidth: 1
                }, ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    </script>

    <!-- //grafik 2 (Data Hektar per tahun) -->
    <script>
        const ctx2 = document.getElementById('myChart2');

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: <?php echo (json_encode($data_arr_tahun)); ?>,
                datasets: [{
                    label: 'Jumlah Hektar(Ha)',
                    data: <?php echo (json_encode($data_arr_hektar)); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    </script>

    <!-- //grafik 2 (Data Hektar per tahun) -->
    <script>
        const ctx3 = document.getElementById('myChart3');

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?php echo (json_encode($data_arr_tahun)); ?>,
                datasets: [{
                    label: 'Jumlah Simpanan Wajib (Rp)',
                    data: <?php echo (json_encode($data_arr_sw)); ?>,
                    borderWidth: 1
                }, {
                    label: 'Jumlah Simpanan Pokok (Rp)',
                    data: <?php echo (json_encode($data_arr_sp)); ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    </script>
</body>

</html>