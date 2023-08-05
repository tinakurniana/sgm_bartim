<?php
// include 'functions/functions-admin.php';

$query_tampil = "SELECT
					*
				FROM
					simpanan_pokok
				INNER JOIN anggota ON simpanan_pokok.id_anggota = anggota.id_anggota
				INNER JOIN tahun ON tahun.id = anggota.id_tahun";
$data = tampilData($query_tampil);

?>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-file-o"></i> Data Simpanan Pokok
			<a target="_blank" href="pages-admin/kelola-simpanan-pokok/cetak-simpanan-pokok.php">
				<button class="btn btn-success pull-right">
					<i class="ace-icon fa fa-print"></i> Cetak
				</button>
			</a>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Data Simpanan Pokok
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>No.Kartu</th>
									<th>No.Registrasi</th>
									<th>Nama</th>
									<th>Mulai Bergabung</th>
									<th>Simpanan Pokok</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$i = 1;
								foreach ($data as $value) {
								?>
									<tr>
										<td class="center"><?= $i; ?></td>
										<td><?= $value['no_kartu'] ?></td>
										<td><?= $value['no_registrasi'] ?></td>
										<td><?= $value['nama'] ?></td>
										<td><?= $value['tahun'] ?></td>
										<td>Rp. <?= number_format($value['simpanan'], 2, ",", "."); ?></td>
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