<?php 
// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);


function simpanProfil($data)
{
    global $conn;
    $keterangan = ($data['editor1']);
    $cek = tampilData("SELECT * FROM profil");
    if (count($cek) == 0) {
        $query = "INSERT INTO profil VALUES ('','$keterangan')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Data Berhasil Disimpan"); location.href = "indexAdmin.php?p=kelola-profil-pt&m=profil";</script>';
        } else {
            echo '<script>alert("Data Gagal Disimpan"); location.href = "indexAdmin.php?p=kelola-profil-pt&m=profil";</script>';
        }
        mysqli_close($conn);
    } else {
        $id = $cek[0]['id'];
        $query = "UPDATE profil SET keterangan = '$keterangan' WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-profil-pt&m=profil";</script>';
        } else {
            echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-profil-pt&m=profil";</script>';
        }
        mysqli_close($conn);
    }
}
?>