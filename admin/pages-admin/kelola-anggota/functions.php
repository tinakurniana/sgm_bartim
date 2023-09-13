<?php

// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

function tambahDataAnggota($data) // Function untuk menambah data anggota
{
    global $conn;

    // mengambil data berdasarkan name yang dikirim dari form
    $no_kartu = htmlspecialchars($data['no_kartu']);
    $no_registrasi = htmlspecialchars($data['no_registrasi']);
    $tahun_bergabung = htmlspecialchars($data['tahun_bergabung']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));
    $alamat = htmlspecialchars($data['alamat']);
    $ktp = htmlspecialchars($data['ktp']);
    $luas_plasma = htmlspecialchars($data['luas_plasma']);
    $no_rek = htmlspecialchars($data['no_rek']);
    $bank = htmlspecialchars($data['bank']);
    $no_hp = htmlspecialchars($data['no_hp']);

    // memanggil function uploadFoto
    $foto = uploadFoto();
    if (!$foto) {
        return false;
    }

    $cek = tampilData("SELECT * FROM anggota WHERE no_kartu = '$no_kartu' OR no_registrasi = '$no_registrasi';");
    $cek2 = tampilData("SELECT pembagian_hasil.id_anggota FROM pembagian_hasil
                        INNER JOIN anggota ON anggota.id_anggota = pembagian_hasil.id_anggota
                        INNER JOIN tahun ON tahun.id = anggota.id_tahun
                        WHERE tahun.id = '$tahun_bergabung';");
    if (count($cek) > 0) {
        echo '<script>alert("Data Gagal Ditambahkan! No.kartu / no.registrasi sudah ada"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    } else if (count($cek2) > 0) {
        echo '<script>alert("Data Gagal Ditambahkan! Pembagian hasil di tahun tersebut sudah dilakukan"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    } else {
        // query untuk insert data anggota
        $query = "INSERT INTO anggota VALUES ('', '$username', '$password', '$nama', '$no_kartu', '$no_registrasi', '$alamat', '$ktp', '$luas_plasma', '$foto', '$no_rek', '$bank', '$tahun_bergabung','$no_hp')";
        // jika query berhasil dieksekusi maka akan menambahkan data lagi ke tabel simpanan pokok
        if (mysqli_query($conn, $query)) {
            // mengembalikan id dari query terakhir
            $id = mysqli_insert_id($conn);
            // query tambah data ke simpanan pokok
            $query2 = "INSERT INTO simpanan_pokok VALUES ('', '$id', 50000)";
            if (mysqli_query($conn, $query2)) {
                echo '<script>alert("Data Berhasil Ditambahkan"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
            } else {
                echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
            }
        } else {
            echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
        }
    }
    mysqli_close($conn);
}

function hapusDataAnggota($data)
{
    global $conn;
    $id_anggota = htmlspecialchars($data['btn-hapus']);

    $query = "DELETE FROM anggota WHERE anggota.id_anggota = '$id_anggota'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    } else {
        echo '<script>alert("Data Berhasil Dihapus"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    }
    mysqli_close($conn);
}

function editDataAnggota($data)
{
    global $conn;
    $id_anggota = htmlspecialchars($data['btn-edit']);
    $no_kartu = htmlspecialchars($data['no_kartu']);
    $no_registrasi = htmlspecialchars($data['no_registrasi']);
    $tahun_bergabung = htmlspecialchars($data['tahun_bergabung']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars(md5($data['password']));
    $alamat = htmlspecialchars($data['alamat']);
    $ktp = htmlspecialchars($data['ktp']);
    $luas_plasma = htmlspecialchars($data['luas_plasma']);
    $no_rek = htmlspecialchars($data['no_rek']);
    $bank = htmlspecialchars($data['bank']);
    $foto = uploadFoto();
    if (!$foto) {
        return false;
    }

    $query = "UPDATE anggota SET username = '$username', password = '$password', nama = '$nama', no_kartu = '$no_kartu', no_registrasi = '$no_registrasi', alamat = '$alamat', ktp = '$ktp', luas_plasma = '$luas_plasma', foto = '$foto', no_rek = '$no_rek', bank = '$bank', id_tahun = '$tahun_bergabung' WHERE id_anggota = '$id_anggota'";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data Berhasil Diedit"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    } else {
        echo '<script>alert("Data Gagal Diedit"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
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
