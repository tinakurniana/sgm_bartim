<?php
include '../../../function-show.php';
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


//setting header tabel excel
$sheet->mergeCells('A1:A2');
$sheet->setCellValue('A1', 'No Kartu');

$sheet->mergeCells('B1:B2');
$sheet->setCellValue('B1', 'Tanggal');

$sheet->mergeCells('C1:C2');
$sheet->setCellValue('C1', 'No Registrasi');

$sheet->mergeCells('D1:D2');
$sheet->setCellValue('D1', 'Nama Anggota');

$sheet->mergeCells('E1:E2');
$sheet->setCellValue('E1', 'Alamat');

$sheet->mergeCells('F1:F2');
$sheet->setCellValue('F1', 'Simpanan Pokok');

$sheet->mergeCells('G1:R1');
$sheet->setCellValue('G1', 'Simpanan Wajib (Bulan)');

$sheet->setCellValue('G2', 'Januari');
$sheet->setCellValue('H2', 'Februari');
$sheet->setCellValue('I2', 'Maret');
$sheet->setCellValue('J2', 'April');
$sheet->setCellValue('K2', 'Mei');
$sheet->setCellValue('L2', 'Juni');
$sheet->setCellValue('M2', 'Juli');
$sheet->setCellValue('N2', 'Agustus');
$sheet->setCellValue('O2', 'September');
$sheet->setCellValue('P2', 'Oktober');
$sheet->setCellValue('Q2', 'November');
$sheet->setCellValue('R2', 'Desember');

$sheet->mergeCells('S1:S2');
$sheet->setCellValue('S1', 'Total');


//menangkap data tahun yang ingin dicetak
$tahun = $_GET['tahun'];
//query mengambil data sesuai tahun
//group concat = untuk menggabungkan beberapa string jadi 1 contoh = Januari, Februari
//concat menggabungkan string dari beberapa field contoh = Januari(5000)

// contoh hasil dari AS bulan = Januari(5000), Februari(10000)
$data = mysqli_query($conn, "SELECT
                                anggota.*,
                                tahun.tahun,
                                simpanan_wajib.tanggal as tanggal,
                                GROUP_CONCAT(
                                    CONCAT(
                                        bulan.bulan,
                                        '(',
                                        simpanan_wajib.simpanan_wajib,
                                        ')'
                                    ) SEPARATOR ', '
                                ) AS bulan
                            FROM
                                simpanan_wajib
                            INNER JOIN anggota ON anggota.id_anggota = simpanan_wajib.id_anggota
                            INNER JOIN tahun ON tahun.id = simpanan_wajib.id_tahun
                            INNER JOIN bulan ON bulan.id = simpanan_wajib.id_bulan
                            WHERE
                                tahun.tahun = '$tahun'
                            GROUP BY
                                anggota.id_anggota
                            ORDER BY
                                tahun.tahun");

$bulan = [
    array(
        "bulan" => "Januari",
        "cell" => "G"
    ),
    array(
        "bulan" => "Februari",
        "cell" => "H"
    ),
    array(
        "bulan" => "Maret",
        "cell" => "I"
    ),
    array(
        "bulan" => "April",
        "cell" => "J"
    ),
    array(
        "bulan" => "Mei",
        "cell" => "K"
    ),
    array(
        "bulan" => "Juni",
        "cell" => "L"
    ),
    array(
        "bulan" => "Juli",
        "cell" => "M"
    ),
    array(
        "bulan" => "Agustus",
        "cell" => "N"
    ),
    array(
        "bulan" => "September",
        "cell" => "O"
    ),
    array(
        "bulan" => "Oktober",
        "cell" => "P"
    ),
    array(
        "bulan" => "November",
        "cell" => "Q"
    ),
    array(
        "bulan" => "Desember",
        "cell" => "R"
    ),
];

$i = 3;
while ($d = mysqli_fetch_array($data)) {
    $total = 0;
    $sheet->setCellValue('A' . $i, $d['no_kartu']);
    $sheet->setCellValue('B' . $i, $d['tanggal']);
    $sheet->setCellValue('C' . $i, $d['no_registrasi']);
    $sheet->setCellValue('D' . $i, $d['nama']);
    $sheet->setCellValue('E' . $i, $d['alamat']);
    $sheet->setCellValue('F' . $i, 50000);
    for ($j = 0; $j < count($bulan); $j++) {
        $cek = strpos($d['bulan'], $bulan[$j]['bulan']);
        if ($cek !== false) {
            $simpanan_wajib = 0;
            $arr_bulan = explode(", ", $d['bulan']);
            foreach ($arr_bulan as $ab) {
                $pos = strpos($ab, "(");
                $sub_bulan = substr($ab, 0, $pos);
                if ($bulan[$j]['bulan'] === $sub_bulan) {
                    $simpanan_wajib = substr($ab, $pos + 1, -1);
                } else {
                    continue;
                }
            }
            $sheet->setCellValue($bulan[$j]['cell'] . $i, $simpanan_wajib);
            $total += $simpanan_wajib;
        } else {
            $sheet->setCellValue($bulan[$j]['cell'] . $i, 0);
        }
    }
    $sheet->setCellValue('S' . $i, $total + 50000);
    $i++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('../../../excel/Data Simpanan Wajib.xlsx');
echo "<script>window.location = '../../../excel/Data Simpanan Wajib.xlsx'</script>";
