<?php
include '../../../function-show.php';
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'No Kartu');
$sheet->setCellValue('C1', 'No Registrasi');
$sheet->setCellValue('D1', 'Nama');
$sheet->setCellValue('E1', 'Mulai Bergabung');
$sheet->setCellValue('F1', 'Simpanan Pokok');

$data = mysqli_query($conn, "SELECT
                                *
                            FROM
                                simpanan_pokok
                            INNER JOIN anggota ON simpanan_pokok.id_anggota = anggota.id_anggota
                            INNER JOIN tahun ON tahun.id = anggota.id_tahun");

$i = 2;
$no = 1;
while ($d = mysqli_fetch_array($data)) {
    $sheet->setCellValue('A' . $i, $no);
    $sheet->setCellValue('B' . $i, $d['no_kartu']);
    $sheet->setCellValue('C' . $i, $d['no_registrasi']);
    $sheet->setCellValue('D' . $i, $d['nama']);
    $sheet->setCellValue('E' . $i, $d['tahun']);
    $sheet->setCellValue('F' . $i, $d['simpanan']);
    $i++;
    $no++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('../../../excel/Data Simpanan Pokok.xlsx');
echo "<script>window.location = '../../../excel/Data Simpanan Pokok.xlsx'</script>";
