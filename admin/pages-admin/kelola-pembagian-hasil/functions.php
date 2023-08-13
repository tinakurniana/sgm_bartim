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
    $id_tahun = htmlspecialchars($data['id_tahun']);
    $id_bulan = htmlspecialchars($data['id_bulan']);
    $total_bersih = htmlspecialchars($data['total_bersih']);

    $potongan = 5000;
    $pendapatan = ($total_bersih+$potongan);

    $cek = tampilData("SELECT * FROM pembagian_hasil WHERE id_anggota = '$id_anggota' AND id_tahun = '$id_tahun' AND id_bulan = '$id_bulan';");
    if (count($cek) > 0) {
        echo '<script>alert("Data Gagal Ditambahkan! Pembagian hasil anggota sudah ada"); location.href = "indexAdmin.php?p=kelola-anggota&m=anggota";</script>';
    } else {
        $query = "INSERT INTO pembagian_hasil VALUES ('', '$id_anggota', '$tanggal', '$pendapatan', '$potongan', '$total_bersih', '$id_tahun', '$id_bulan')";
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

?>