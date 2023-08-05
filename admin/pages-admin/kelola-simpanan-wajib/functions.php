<?php 

// mengkoneksikan ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'skripsi-pirda2';
$conn = mysqli_connect($host, $username, $password, $dbname);

//convert bulan jadi angka
function convertBulan($bulan)
{
    $bulanAngka = null;
    switch ($bulan) {
        case 'Januari':
            $bulanAngka = '01';
            break;
        case 'Februari':
            $bulanAngka = '02';
            break;
        case 'Maret':
            $bulanAngka = '03';
            break;
        case 'April':
            $bulanAngka = '04';
            break;
        case 'Mei':
            $bulanAngka = '05';
            break;
        case 'Juni':
            $bulanAngka = '06';
            break;
        case 'Juli':
            $bulanAngka = '07';
            break;
        case 'Agustus':
            $bulanAngka = '08';
            break;
        case 'September':
            $bulanAngka = '09';
            break;
        case 'Oktober':
            $bulanAngka = '10';
            break;
        case 'November':
            $bulanAngka = '11';
            break;
        case 'Desember':
            $bulanAngka = '12';
            break;
    }
    return $bulanAngka;
}

function tambahDataSimpananWajib($data)
{
    global $conn;
    $id_anggota = htmlspecialchars($data['no_kartu']);
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);
    $simpanan_wajib = htmlspecialchars($data['simpanan_wajib']);
    $tanggal = htmlspecialchars($data['tanggal']);

    $query = "INSERT INTO simpanan_wajib VALUES ('', '$id_anggota','$simpanan_wajib','$id_bulan', '$id_tahun', '$tanggal')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data Berhasil Ditambahkan'); 
                location.href = 'indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal Ditambahkan'); 
                location.href = 'indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
    }
    mysqli_close($conn);
}

function editDataSimpananWajib($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-edit']);
    $id_anggota = htmlspecialchars($data['no_kartu']);
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);
    $simpanan_wajib = htmlspecialchars($data['simpanan_wajib']);
    $tanggal = htmlspecialchars($data['tanggal']);

    $query = "UPDATE simpanan_wajib SET id_anggota = '$id_anggota', simpanan_wajib = '$simpanan_wajib', tanggal = '$tanggal' WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Data Berhasil Diedit'); 
            location.href = 'indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
        </script>";
    } else {
        echo "<script>
            alert('Data Gagal Diedit'); 
            location.href = 'indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
        </script>";
    }
    mysqli_close($conn);
}

function hapusDataSimpananWajib($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-hapus']);
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);

    $query = "DELETE FROM simpanan_wajib WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data Berhasil Dihapus'); 
                location.href = 'indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal Dihapus'); 
                location.href = 'indexAdmin.php?p=kelola-simpanan-wajib&m=simpanan-wajib&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
    }
    mysqli_close($conn);
}


?>