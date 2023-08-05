<?php 
// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

function simpanKontak($data)
{
    global $conn;
    // $id_kontak = htmlspecialchars($data['btn-simpan']);
    $alamat = htmlspecialchars($data['alamat']);
    $telp = htmlspecialchars($data['telp']);
    $email = htmlspecialchars($data['email']);

    $cek = tampilData("SELECT * FROM kontak");
    if (count($cek) == 0) {
        $query = "INSERT INTO kontak VALUES ('', '$alamat', '$telp', '$email')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Data Berhasil Disimpan"); location.href = "indexAdmin.php?p=kelola-kontak&m=kontak";</script>';
        } else {
            echo '<script>alert("Data Gagal Disimpan"); location.href = "indexAdmin.php?p=kelola-kontak&m=kontak";</script>';
        }
        mysqli_close($conn);
    } else {
        $id = $cek[0]['id'];
        $query = "UPDATE kontak SET alamat = '$alamat', telp = '$telp', email = '$email' WHERE id = '$id'";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-kontak&m=kontak";</script>';
        } else {
            echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-kontak&m=kontak";</script>';
        }
        mysqli_close($conn);
    }
}

?>