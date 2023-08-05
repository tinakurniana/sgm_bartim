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

function tambahDataPembagianHasil($data)
{
    global $conn;
    $id_anggota = htmlspecialchars($data['id_anggota']);
    $tanggal = htmlspecialchars($data['tanggal']);
    $id_hasil_produksi = htmlspecialchars($data['id_hasil_produksi']);
    $hasil_produksi = htmlspecialchars($data['hasil_produksi']);
    $total_luas = htmlspecialchars($data['total_luas']);
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);

    $luas_anggota = tampilData("SELECT luas_plasma FROM anggota WHERE id_anggota = '$id_anggota'");

    $pendapatan = (((float)$hasil_produksi/(float)$total_luas)*(float)$luas_anggota[0]['luas_plasma']);
    $potongan = 5000;
    $total_bersih = $pendapatan - $potongan;

    $cek = tampilData("SELECT * FROM pembagian_hasil WHERE id_anggota = '$id_anggota';");
    if (count($cek) > 0) {
        echo '<script>alert("Data Gagal Ditambahkan! Pembagian hasil anggota sudah ada"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    } else {
        $query = "INSERT INTO pembagian_hasil VALUES ('', '$id_anggota', '$tanggal', '$pendapatan', '$potongan', '$total_bersih', '$id_hasil_produksi')";
        // jika query berhasil dieksekusi maka akan menambahkan data lagi ke tabel simpanan wajib
        if (mysqli_query($conn, $query)) {
            // query tambah data ke simpanan pokok
            $query2 = "INSERT INTO simpanan_wajib VALUES ('', '$id_anggota', '$tanggal', 5000, '$id_bulan', '$id_tahun')";
            if (mysqli_query($conn, $query2)) {
                echo "<script>
                    alert('Data Berhasil Ditambahkan'); 
                    location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=$id_tahun&id_bulan=$id_bulan';
                </script>";
            } else {
                echo "<script>
                    alert('Data Berhasil Ditambahkan'); 
                    location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=$id_tahun&id_bulan=$id_bulan';
                </script>";
            }
        } else {
            echo '<script>alert("Data Gagal Ditambahkan"); location.href = "indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=$id_tahun&id_bulan=$id_bulan";</script>';
        }
    }
    mysqli_close($conn);
}

function hapusDataPembagianHasil($data)
{
    global $conn;
    $id = htmlspecialchars($data['btn-hapus']);
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);

    $query = "DELETE FROM pembagian_hasil WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data Berhasil Dihapus'); 
                location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=$id_tahun&id_bulan=$id_bulan';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal Dihapus'); 
                location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=$id_tahun&id_bulan=$id_bulan';
            </script>";
    }
    mysqli_close($conn);
}

function tambahHasilProduksi($data)
{
    global $conn;
    $total_luas = ($data['total_luas']);
    $total_hasil_produksi = ($data['total_hasil_produksi']);
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);

    $cek = tampilData("SELECT * FROM hasil_produksi WHERE id_tahun = '$id_tahun' AND id_bulan = '$id_bulan'");
    if (count($cek) == 0) {
        $query = "INSERT INTO hasil_produksi VALUES ('', '$total_luas', '$total_hasil_produksi', '$id_tahun', '$id_bulan')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                alert('Data Berhasil Ditambahkan'); 
                location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
        } else {
            echo "<script>
                alert('Data Berhasil Ditambahkan'); 
                location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
        }
        mysqli_close($conn);
    } else {
        $id = $cek[0]['id'];
        $query = "UPDATE hasil_produksi SET total_hasil_produksi = '$total_hasil_produksi' WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                alert('Data Berhasil Ditambahkan'); 
                location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
        } else {
            echo "<script>
                alert('Data Berhasil Ditambahkan'); 
                location.href = 'indexAdmin.php?p=kelola-pembagian-hasil&m=pembagian-hasil&id_tahun=" . $id_tahun . "&id_bulan=" . $id_bulan . "';
            </script>";
        }
        mysqli_close($conn);
    }
}
?>