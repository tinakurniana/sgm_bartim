<?php
include 'functions.php';

$id = $_SESSION['id'];
// $query_tampil = "SELECT * FROM anggota WHERE id_anggota = $id";
// $anggota = tampilData($query_tampil);

$query_tampil = "SELECT
					*,
					tahun.tahun
				FROM
					anggota
				INNER JOIN tahun on tahun.id = anggota.id_tahun
                WHERE id_anggota = $id;";
$anggota = tampilData($query_tampil);

if (isset($_POST['btn-edit'])) {
    editProfil($_POST);
}

?>

<div class="page-content">
    <div class="page-header">
        <h1 style="color:#585858">
            <i class="ace-icon fa fa-user"></i>
            Data Diri
        </h1>
    </div><!-- /.page-header -->

    <div class="row">
        <div class="col-xs-12">
            <!--PAGE CONTENT BEGINS-->
            <div>
                <div id="user-profile-1" class="user-profile row">
                    <div class="col-xs-12 col-sm-3 center">
                        <div>
                            <span class="profile-picture">
                                <img id="avatar" class="editable img-responsive" alt="img" src="../admin/assets-admin/images/<?= $anggota[0]['foto'] ?>" />
                            </span>

                            <div class="space-4"></div>

                            <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
                                <div class="inline position-relative">
                                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                        <i class="ace-icon fa fa-circle light-green"></i>
                                        &nbsp;
                                        <span class="white"><?= $anggota[0]['nama'] ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="space-6"></div>
                    </div>

                    <div class="col-xs-12 col-sm-9">

                        <div class="profile-user-info profile-user-info-striped">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Username :</div>
                                <div class="profile-info-value">
                                    <span class="editable" id="username"><?= $anggota[0]['username'] ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> No.Kartu :</div>
                                <div class="profile-info-value">
                                    <span class="editable" id="no_kartu"><?= $anggota[0]['no_kartu'] ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> No.Registrasi :</div>
                                <div class="profile-info-value">
                                    <span class="editable" id="no_registrasi"><?= $anggota[0]['no_registrasi'] ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Bergabung :</div>
                                <div class="profile-info-value">
                                    <span class="editable" id="no_registrasi"><?= $anggota[0]['tahun'] ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Alamat :</div>

                                <div class="profile-info-value">
                                    <i class="fa fa-map-marker light-orange bigger-110"></i>
                                    <span class="editable" id="alamat"><?= $anggota[0]['alamat'] ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> KTP :</div>

                                <div class="profile-info-value">
                                    <span class="editable" id="ktp"><?= $anggota[0]['ktp'] ?></span>
                                </div>
                            </div>

                            <div class="profile-info-row">
                                <div class="profile-info-name"> Luas Plasma :</div>

                                <div class="profile-info-value">
                                    <span class="editable" id="luas_plasma"><?= $anggota[0]['luas_plasma'] ?> Ha</span>
                                </div>
                            </div>
                            <br>
                            <div>
                                <a data-toggle="modal" href="#edit-profil">
                                    <button type="button" class="btn btn-primary btn-round">
                                        <span class="bigger-110">Edit Profil</span>
                                    </button>
                                </a>
                            </div>
                            <br>
                        </div>

                        <div class="space-20"></div>
                    </div>
                </div>
            </div>
            <!--PAGE CONTENT ENDS-->
        </div><!--/.span-->
    </div><!--/.row-fluid-->


    <!-- Modal Edit Profil -->
    <div class="modal fade" id="edit-profil">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="ace-icon fa fa-edit"> Form Edit Profil</i></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="row-sm-4">
                                    <label class="control-label" for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" value="<?= $anggota[0]['nama']; ?>" class="col-xs-12 col-sm-12" required />
                                </div>
                                <div class="row-sm-4">
                                    <label class="control-label" for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="10" row-sm-4s="5" class="col-xs-12 col-sm-12" required><?= $anggota[0]['alamat']; ?></textarea>
                                </div>
                                <div class="row-sm-4">
                                    <label class="control-label" for="foto">Pas Foto</label>
                                    <input type="file" id="id-input-file-2" name="foto" class="col-xs-12 col-sm-12" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn-edit">Edit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- End Edit Profil -->

</div><!--/.page-content-->