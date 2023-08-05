<?php
include 'functions.php';

$query_tampil = "SELECT * FROM profil";
$profil = tampilData($query_tampil);

if (isset($_POST['btn-tambah'])) {
    simpanProfil($_POST);
}

?>

<div class="page-content">
    <div class="page-header">
        <h1 style="color:#585858">
            <i class="ace-icon fa fa-folder-o"></i> Kelola Konten Profil PT Sawit Graha Manunggal Halaman Pengunjung
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <form class="form-horizontal" role="form" action="" method="POST">
                    <div class="col-xs-12">
                        <div id="editor"></div>
                        <textarea name="editor1">
                            <?= $profil == null ? null : $profil[0]['keterangan'] ?>
                        </textarea>
                        <script>
                            CKEDITOR.replace('editor1');
                        </script>
                        <div class="clearfix form-actions">
                            <div class="col-md-3 col-md-9">
                                <button class="btn btn-info" type="submit" name="btn-tambah" value="<?= $profil == null ? null : $profil[0]['id'] ?>">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div><!-- PAGE CONTENT ENDS -->
                </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->