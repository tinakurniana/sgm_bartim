<?php
include '../../../function-show.php';
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Tanggal');
$sheet->setCellValue('C1', 'No.Kartu');
$sheet->setCellValue('D1', 'No.Registrasi');
$sheet->setCellValue('E1', 'Nama');
$sheet->setCellValue('F1', 'No.Rek');
$sheet->setCellValue('G1', 'Bank');
$sheet->setCellValue('H1', 'Luas Plasma');
$sheet->setCellValue('I1', 'Pendapatan');
$sheet->setCellValue('J1', 'Potongan');
$sheet->setCellValue('K1', 'Pendapatan Bersih');

$id_tahun = $_GET['id_tahun'];
$id_bulan = $_GET['id_bulan'];

$data = mysqli_query($conn, "SELECT * FROM pembagian_hasil
                            INNER JOIN anggota ON anggota.id_anggota = pembagian_hasil.id_anggota
                            WHERE
                            pembagian_hasil.id_tahun = $id_tahun AND pembagian_hasil.id_bulan = $id_bulan");

$i = 2;
$no = 1;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $d['tanggal']);
    $sheet->setCellValue('C' . $i, $d['no_kartu']);
    $sheet->setCellValue('D' . $i, $d['no_registrasi']);
    $sheet->setCellValue('E' . $i, $d['nama']);
    $sheet->setCellValue('F' . $i, $d['no_rek']);
    $sheet->setCellValue('G' . $i, $d['bank']);
    $sheet->setCellValue('H' . $i, $d['luas_plasma']);
    $sheet->setCellValue('I' . $i, $d['pendapatan']);
    $sheet->setCellValue('J' . $i, $d['potongan']);
    $sheet->setCellValue('K' . $i, $d['total_bersih']);
    $i++;
    $no++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('../../../excel/Data Pembagian Hasil.xlsx');
echo "<script>window.location = '../../../excel/Data Pembagian Hasil.xlsx'</script>";
