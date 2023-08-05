<?php
error_reporting(0);

include '../../function-show.php';

$query_tampil = "SELECT * FROM pengurus";
$pengurus = tampilData($query_tampil);
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
    <title>Cetak Data Pengurus</title>
</head>

<body>
    <div class="page-content">
        <h3 class="text-center">Data Pengurus</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto Pengurus</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>No.HP</th>
                    <th>KTP</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 1;
                foreach ($pengurus as $row) :
                ?>
                    <tr>
                        <td class="center"><?= $i++; ?></td>
                        <td class="center">
                            <img src="../../assets-admin/images/<?= $row["foto"]; ?>" alt="foto-user" width="100px">
                        </td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jabatan']; ?></td>
                        <td><?= $row['no_hp']; ?></td>
                        <td><?= $row['ktp']; ?></td>
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