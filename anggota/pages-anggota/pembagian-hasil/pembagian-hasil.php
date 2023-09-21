<?php

$id = $_SESSION['id'];

$query_tampil = "SELECT
                    pembagian_hasil.*, 
					anggota.*
                FROM
                    pembagian_hasil
				INNER JOIN anggota ON anggota.id_anggota = pembagian_hasil.id_anggota
                WHERE anggota.id_anggota = $id";
$pembagian_hasil = tampilData($query_tampil);

$query_total = "SELECT SUM(total_bersih) AS total FROM pembagian_hasil
				INNER JOIN anggota ON anggota.id_anggota = pembagian_hasil.id_anggota
				WHERE anggota.id_anggota = $id";
$total_pendapatan = tampilData($query_total);

?>


<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-list"></i> Data Pembagian Hasil
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
                <div class="col-xs-12">
                    <div class="well">
                        <h4 class="blue smaller dark">Total Pendapatan Bersih</h4>
						Rp. <?= number_format($total_pendapatan[0]['total'], 2, ",", "."); ?>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Data Pembagian Hasil
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Tanggal</th>
									<th>No.Kartu</th>
									<th>No.Registrasi</th>
									<th>Nama</th>
									<th>No Rek</th>
									<th>Bank</th>
									<th>Luas Plasma</th>
									<th>Pendapatan</th>
									<th>Potongan</th>
									<th>Pendapatan Bersih</th>
								</tr>
							</thead>

							<tbody>

								<?php
								$i = 1;
								foreach ($pembagian_hasil as $value) {
								?>
									<tr>
										<td class="center"><?= $i; ?></td>
										<td><?= $value['tanggal'] ?></td>
										<td><?= $value['no_kartu'] ?></td>
										<td><?= $value['no_registrasi'] ?></td>
										<td><?= $value['nama'] ?></td>
										<td><?= $value['no_rek'] ?></td>
										<td><?= $value['bank'] ?></td>
										<td><?= $value['luas_plasma'] ?> Ha</td>
										<td>Rp. <?= number_format($value['pendapatan'], 2, ",", "."); ?></td>
										<td>Rp. <?= number_format($value['potongan'], 2, ",", "."); ?></td>
										<td>Rp. <?= number_format($value['total_bersih'], 2, ",", "."); ?></td>
									</tr>
								<?php
									$i++;
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->