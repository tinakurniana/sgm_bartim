<?php
error_reporting(0);

include '../../../function-show.php';

$query_tampil = "select
                    *,
                    tahun.tahun
                from
                    anggota
                inner join tahun on tahun.id = anggota.id_tahun";
$anggota = tampilData($query_tampil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../../assets-admin/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../../assets-admin/plugins/font-awesome-4.6.3/css/font-awesome.min.css" />

    <!--fonts-->
    <link rel="stylesheet" type="text/css" href="../../assets-admin/fonts/fonts.googleapis.com.css" />

    <!--ace styles-->
    <link rel="stylesheet" type="text/css" href="../../assets-admin/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" type="text/css" href="../../assets-admin/js/ace-extra.min.js" />
    <title>Document</title>
</head>

<body>
    <div class="page-content">
        <h3 class="text-center">Data Anggota</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No.Kartu</th>
                    <th>No.Registrasi</th>
                    <th>Mulai Bergabung</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>KTP</th>
                    <th>Luas Plasma</th>
                    <th>Foto Anggota</th>
                    <th>No.Rek</th>
                    <th>Bank</th>
                    <th>Username</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1;
                foreach ($anggota as $row) :
                ?>
                    <tr>
                        <td class="center"><?= $i++; ?></td>
                        <td><?= $row['no_kartu']; ?></td>
                        <td><?= $row['no_registrasi']; ?></td>
                        <td><?= $row['tahun']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['ktp']; ?></td>
                        <td><?= $row['luas_plasma']; ?> Ha</td>
                        <td class="center">
                            <img src="../../assets-admin/images/<?= $row["foto"]; ?>" class="img-fluid" width="100px">
                        </td>
                        <td><?= $row['no_rek']; ?></td>
                        <td><?= $row['bank']; ?></td>
                        <td><?= $row['username']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    window.print();
</script>
</html>