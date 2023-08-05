<?php

// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

function tambahDataPengurus($data) // Function untuk menambahkan data pengurus
{
    global $conn;

    // mengambil data berdasarkan name yang dikirim dari form
    $nama = htmlspecialchars($data['nama']);
    $jabatan = htmlspecialchars($data['jabatan']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $ktp = htmlspecialchars($data['ktp']);

    // memanggil function uploadFoto
    $foto = uploadFoto();
    if (!$foto) {
        return false;
    }

    // query untuk insert data ke db
    $query = "INSERT INTO pengurus VALUES ('', '$nama', '$jabatan', '$no_hp', '$ktp', '$foto')";

    // jika query berhasil dieksekusi maka menampilkan alert data berhasil dan reload ke halaman pengurus
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Ditambahkan"); location.href = "indexAdmin.php?p=kelola-pengurus&m=pengurus";</script>';
    }
    // jika query tidak berhasil dieksekusi maka menampilkan alert data gagal dan reload ke halaman pengurus
    else {
        echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-pengurus&m=pengurus";</script>';
    }

    // menghentikan koneksi php ke server mysql
    mysqli_close($conn);
}

function hapusDataPengurus($data) // Function untuk menghapus data pengurus
{
    global $conn;

    // mengambil id pengurus dari name button hapus
    $id_pengurus = htmlspecialchars($data['btn-hapus']);

    // query untuk hapus data dari db
    $query = "DELETE FROM pengurus WHERE pengurus.id_pengurus = '$id_pengurus'";

    // jika query berhasil dieksekusi maka menampilkan alert data berhasil dan reload ke halaman pengurus
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-pengurus&m=pengurus";</script>';
    }
    // jika query tidak berhasil dieksekusi maka menampilkan alert data gagal dan reload ke halaman pengurus
    else {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-pengurus&m=pengurus";</script>';
    }

    // menghentikan koneksi php ke server mysql
    mysqli_close($conn);
}

function editDataPengurus($data) // Function untuk mengedit data pengurus
{
    global $conn;

    // mengambil data berdasarkan name yang dikirim dari form
    $id_pengurus = htmlspecialchars($data['btn-edit']);
    $nama = htmlspecialchars($data['nama']);
    $jabatan = htmlspecialchars($data['jabatan']);
    $no_hp = htmlspecialchars($data['no_hp']);
    $ktp = htmlspecialchars($data['ktp']);

    // memanggil function uploadFoto
    $foto = uploadFoto();
    if (!$foto) {
        return false;
    }

    // query untuk edit data
    $query = "UPDATE pengurus SET nama = '$nama', jabatan = '$jabatan', no_hp = '$no_hp', ktp = '$ktp', foto = '$foto' WHERE id_pengurus = '$id_pengurus'";

    // jika query berhasil dieksekusi maka menampilkan alert data berhasil dan reload ke halaman pengurus
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-pengurus&m=pengurus";</script>';
    }
    // jika query gagal dieksekusi maka menampilkan alert data gagasl dan reload ke halaman pengurus
    else {
        echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-pengurus&m=pengurus";</script>';
    }

    // menghentikan koneksi php ke server mysql
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