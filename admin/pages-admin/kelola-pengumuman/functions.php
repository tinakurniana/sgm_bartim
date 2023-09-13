<?php

// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

function tambahDataPengumuman($data)
{
    global $conn;
    $judul = htmlspecialchars($data['judul']);
    $pengumuman = htmlspecialchars($data['pengumuman']);

    $query = "INSERT INTO pengumuman VALUES ('','$pengumuman','$judul')";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Ditambahkan"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
    } else {
        echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
    }
    mysqli_close($conn);
}

function editDataPengumuman($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-edit']);
    $pengumuman = htmlspecialchars($data['pengumuman']);
    $judul = htmlspecialchars($data['judul']);

    $query = "UPDATE pengumuman SET pengumuman = '$pengumuman', judul = '$judul' WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
    } else {
        echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
    }
    mysqli_close($conn);
}

function hapusDataPengumuman($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-hapus']);

    $query = "DELETE FROM pengumuman WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
    } else {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
    }
    mysqli_close($conn);
}

function shareWA($data)
{
    $id = htmlspecialchars($data['shareWA']);

    $no_hp = tampilData("SELECT CONCAT('62', SUBSTR(no_hp, 2, CHAR_LENGTH(no_hp))) AS no_hp FROM anggota");
    $getPengumuman = tampilData("SELECT pengumuman, judul FROM pengumuman WHERE id = $id");

    $judul = '';
    $isi = '';
    if (count($getPengumuman) > 0) {
        $judul = $getPengumuman[0]['judul'];
        $isi = $getPengumuman[0]['pengumuman'];
    }

    $pengumuman = "
        <h2>
            <strong>$judul</strong>
        </h2>
	    <br>
	    <p>$isi</p>
    ";

    $target = null;
    foreach ($no_hp as $val) {
        $target .= "'" . $val['no_hp'] . "',";
    }

    $token = 'LC+_A57YaHXT#i_dZiuk';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => $pengumuman,
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: $token"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    echo '<script>alert("Pengumuman Sudah Disebar Untuk Seluruh Anggota"); location.href = "indexAdmin.php?p=kelola-pengumuman&m=kelola-pengumuman";</script>';
}
