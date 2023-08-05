<?php 
// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

function tambahDataGaleri($data)
{
    global $conn;
    $judul = htmlspecialchars($data['judul']);
    $keterangan = htmlspecialchars($data['keterangan']);

    $foto = uploadFoto();
    if (!$foto) {
        return false;
    }

    $query = "INSERT INTO galeri VALUES ('', '$foto', '$judul', '$keterangan')";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Ditambahkan"); location.href = "indexAdmin.php?p=kelola-galeri&m=galeri";</script>';
    } else {
        echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-galeri&m=galeri";</script>';
    }
    mysqli_close($conn);
}

function hapusDataGaleri($data)
{
    global $conn;
    $id_galeri = htmlspecialchars($data['btn-hapus']);

    $query = "DELETE FROM galeri WHERE galeri.id_galeri = '$id_galeri'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-galeri&m=galeri";</script>';
    } else {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-galeri&m=galeri";</script>';
    }
    mysqli_close($conn);
}

function editDataGaleri($data)
{
    global $conn;
    $id_galeri = htmlspecialchars($data['btn-edit']);
    $judul = htmlspecialchars($data['judul']);
    $keterangan = htmlspecialchars($data['keterangan']);

    $foto = uploadFoto();
    if (!$foto) {
        return false;
    }

    $query = "UPDATE galeri SET foto = '$foto', judul = '$judul', keterangan = '$keterangan' WHERE id_galeri = '$id_galeri'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-galeri&m=galeri";</script>';
    } else {
        echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-galeri&m=galeri";</script>';
    }
    mysqli_close($conn);
}

function uploadFoto()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if (
        $error === 4
    ) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $eksetensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $eksetensiGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukuran terlalu besar
    if (
        $ukuranFile > 10000000
    ) {
        echo "<script>
                alert('Ukuran gambar terlalu besar! (Max. 10MB)');
              </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'assets-admin/images/' . $namaFileBaru);
    return $namaFileBaru;
}

?>