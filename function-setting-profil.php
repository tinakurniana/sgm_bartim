<?php 

// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);


function resetPassword($data)
{
    global $conn;
    $id = htmlspecialchars($data['reset']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));
    $role = htmlspecialchars($data['role']);

    if ($role == 'admin') {
        $query = "UPDATE admin SET username = '$username', password = '$password' WHERE id_admin = $id";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Reset Password Berhasil"); location.href = "indexAdmin.php";</script>';
        } else {
            echo '<script>alert("Reset Password Gagal"); location.href = "indexAdmin.php";</script>';
        }
    } else {
        $query = "UPDATE anggota SET username = '$username', password = '$password' WHERE id_anggota = $id";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("Reset Password Berhasil"); location.href = "indexAnggota.php";</script>';
        } else {
            echo '<script>alert("Reset Password Gagal"); location.href = "indexAnggota.php";</script>';
        }
    }
}


?>