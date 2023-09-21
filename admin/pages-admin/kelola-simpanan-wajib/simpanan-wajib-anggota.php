<?php
include 'functions.php';

$id_anggota = $_GET['id_anggota'];

$query_simpanan_wajib = "SELECT
							*
						FROM
							simpanan_wajib
						INNER JOIN anggota ON anggota.id_anggota = simpanan_wajib.id_anggota
                        WHERE anggota.id_anggota = '$id_anggota'";
$simpanan_wajib = tampilData($query_simpanan_wajib);

$query_anggota = "SELECT * FROM anggota WHERE id_anggota = '$id_anggota'";
$anggota = tampilData($query_anggota);

$query_jumlah = "SELECT SUM(simpanan_wajib) AS jumlah FROM simpanan_wajib
                INNER JOIN anggota ON anggota.id_anggota = simpanan_wajib.id_anggota
                WHERE anggota.id_anggota = $id_anggota";
$jumlah_simpanan = tampilData($query_jumlah);

?>


<div class="page-content">
    <div class="page-header">
        <h1 style="color:#585858">
            <i class="ace-icon fa fa-file-o"></i> Simpanan Wajib <?= $anggota[0]['nama']; ?>
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <div class="well">
                <h4 class="blue smaller dark">Total Simpanan Wajib</h4>
                Rp. <?= number_format($jumlah_simpanan[0]['jumlah'], 2, ",", "."); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-header">
                        Data Simpanan Wajib
                    </div>
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Simpanan Wajib</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($simpanan_wajib as $sw) {
                                ?>
                                    <tr>
                                        <td class="center"><?= $i ?></td>
                                        <td><?= $sw['tanggal'] ?></td>
                                        <td>Rp. <?= number_format($sw['simpanan_wajib'], 2, ",", "."); ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->

</div><!-- /.page-content -->