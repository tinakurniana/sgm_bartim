<?php

// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

function tambahDataTahun($data)
{
    global $conn;
    $tahun = htmlspecialchars($data['tahun']);

    $cek = tampilData("SELECT tahun FROM tahun WHERE tahun = $tahun");
    if (count($cek) > 0) {
        echo '<script>alert("Data Gagal Ditambahkan, Tahun Sudah Ada"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
    } else {
        $query = "INSERT INTO tahun VALUES ('', '$tahun')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Data Berhasil Ditambahkan"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
        } else {
            echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
        }
    }
    mysqli_close($conn);
}

function editDataTahun($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-edit']);
    $tahun = htmlspecialchars($data['tahun']);

    $cek = tampilData("SELECT tahun FROM tahun WHERE tahun = $tahun");

    if (count($cek) > 0) {
        echo '<script>alert("Data Gagal Diedit, Tahun Sudah Ada"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
    } else {
        $query = "UPDATE tahun SET tahun = '$tahun' WHERE id = '$id'";

        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
        } else {
            echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
        }
    }
    mysqli_close($conn);
}

function hapusDataTahun($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-hapus']);

    $query = "DELETE FROM tahun WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
    } else {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-tahun&m=kelola-tahun";</script>';
    }
    mysqli_close($conn);
}

?>