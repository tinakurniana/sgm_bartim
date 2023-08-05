<?php
// include 'functions/functions-admin.php';

$id = $_SESSION['id'];

$query_tampil = "SELECT
                    simpanan_wajib.*,
                    anggota.no_kartu,
                    anggota.no_registrasi,
                    anggota.nama
                FROM
                    simpanan_wajib
                INNER JOIN anggota ON anggota.id_anggota = simpanan_wajib.id_anggota
                WHERE anggota.id_anggota = $id";
$anggota = tampilData($query_tampil);

?>

<div class="page-content">
    <div class="page-header">
        <h1 style="color:#585858">
            <i class="ace-icon fa fa-file-o"></i> Data Simpanan Anggota (Pokok dan Wajib)
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">

                <div class="col-xs-12">
                    <div class="well">
                        <h4 class="blue smaller dark">Simpanan Pokok</h4>
                        Rp 50.000,00
                    </div>

                </div>

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
                                    <th>No.Kartu</th>
                                    <th>No.Registrasi</th>
                                    <th>Nama</th>
                                    <th>Simpanan Wajib</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $i = 1;
                                foreach ($anggota as $value) {
                                ?>
                                    <tr>
                                        <td class="center"><?= $i; ?></td>
                                        <td><?= $value['no_kartu'] ?></td>
                                        <td><?= $value['no_registrasi'] ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td>Rp. <?= number_format($value['simpanan_wajib'], 2, ",", "."); ?></td>
                                        <td><?= $value['tanggal'] ?></td>
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