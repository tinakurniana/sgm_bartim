<?php
include 'functions.php';

$id_tahun = $_GET['id_tahun'];
$id_bulan = $_GET['id_bulan'];

$query_hasil_produksi = "SELECT * FROM hasil_produksi WHERE id_tahun = '$id_tahun' AND id_bulan = '$id_bulan'";
$hasil_produksi = tampilData($query_hasil_produksi);

if (count($hasil_produksi) > 0) {
	$id_hasil_produksi = $hasil_produksi[0]['id'];

	$query_pembagian_hasil = "SELECT
							*
						FROM
							pembagian_hasil
						INNER JOIN anggota ON anggota.id_anggota = pembagian_hasil.id_anggota
						WHERE
							pembagian_hasil.id_hasil_produksi = $id_hasil_produksi;";
	$pembagian_hasil = tampilData($query_pembagian_hasil);
}

$tahun_terkecil = tampilData("SELECT tahun FROM tahun ORDER BY tahun ASC LIMIT 1");
$tahun_terkecil = $tahun_terkecil[0]['tahun'];

$query_tahun_now = "SELECT * FROM tahun WHERE id = '$id_tahun'";
$tahun_now = tampilData($query_tahun_now);
$tahun_now2 = $tahun_now[0]['tahun'];

$query_bulan_now = "SELECT * FROM bulan WHERE id = '$id_bulan'";
$bulan_now = tampilData($query_bulan_now);
$bulan_now2 = convertBulan($bulan_now[0]['bulan']);

$dateString = $tahun_now[0]['tahun'] . '-' .  $bulan_now2  . '-01';
$lastDateOfMonth = date("Y-m-t", strtotime($dateString));

$query_anggota = "SELECT anggota.* FROM anggota INNER JOIN tahun ON anggota.`id_tahun` = tahun.`id`
					WHERE tahun.`tahun` BETWEEN '$tahun_terkecil' AND '$tahun_now2' AND NOT EXISTS 
                        (SELECT * 
                            FROM pembagian_hasil 
                            WHERE pembagian_hasil.id_anggota = anggota.id_anggota);";
$anggota = tampilData($query_anggota);

$query_luas = "SELECT SUM(luas_plasma) AS luas FROM anggota INNER JOIN tahun ON anggota.`id_tahun` = tahun.`id`
WHERE tahun.`tahun` BETWEEN '$tahun_terkecil' AND '$tahun_now2';";
$total_luas = tampilData($query_luas);


if (isset($_POST['btn-simpan-hasil-produksi'])) {
	tambahHasilProduksi($_POST);
}
if (isset($_POST['btn-tambah'])) {
	tambahDataPembagianHasil($_POST);
}
if (isset($_POST['btn-hapus'])) {
	hapusDataPembagianHasil($_POST);
}
?>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-list"></i> Luas Plasma dan Jumlah Hasil Produksi Petani Bulan <?= $bulan_now[0]['bulan']; ?> Tahun <?= $tahun_now[0]['tahun']; ?>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<!--PAGE CONTENT BEGINS-->
					<form class="form-horizontal" role="form" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label class="col-sm-2 control-label no-padding-right">Total Luas Plasma (Ha) : </label>
							<div class="col-sm-9">
								<input readonly="" type="text" class="col-xs-12 col-sm-5" name="total_luas" id="total_luas" value="<?= $total_luas[0]['luas']; ?>" />
							</div>
							<br><br>
							<label class="col-sm-2 control-label no-padding-right">Total Hasil Produksi Petani : </label>
							<div class="col-sm-9">
								<input type="text" class="col-xs-12 col-sm-5" name="total_hasil_produksi" id="total_hasil_produksi" value="<?= $hasil_produksi == null ? null : $hasil_produksi[0]['total_hasil_produksi'] ?>" required />
							</div>
							<input type="hidden">
						</div>
						<div class="clearfix form-actions">
							<div class="col-md-offset-2 col-md-10">
								<input type="hidden" name="id_tahun" value="<?= $id_tahun ?>">
								<input type="hidden" name="id_bulan" value="<?= $id_bulan ?>">
								<input type="hidden" name="id_hasil_produksi" value="<?= $id_hasil_produksi ?>">
								<button type="submit" class="btn btn-primary" name="btn-simpan-hasil-produksi">Simpan</button>
							</div>
						</div>
					</form>
					<!--PAGE CONTENT ENDS-->
				</div><!--/.span-->
			</div><!--/.row-fluid-->
		</div><!-- /.col -->
	</div><!-- /.row -->

	<?php if (count($hasil_produksi) > 0) { ?>

		<div class="page-header">
			<h1 style="color:#585858">
				<i class="ace-icon fa fa-list"></i> Pembagian Hasil Produksi Anggota Bulan <?= $bulan_now[0]['bulan']; ?> Tahun <?= $tahun_now[0]['tahun']; ?>
				<a href="pages-admin/kelola-pembagian-hasil/cetak-pembagian-hasil.php?id_tahun=<?= $id_tahun ?>&id_bulan=<?= $id_bulan ?>" target="_blank">
					<button class="btn btn-success pull-right">
						<i class="ace-icon fa fa-print"></i> Cetak
					</button>
				</a>
				<a data-toggle="modal" href="#tambah-data">
					<button class="btn btn-primary pull-right">
						<i class="ace-icon fa fa-plus"></i> Tambah Data
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
							Data Pembagian Hasil Produksi
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
										<th>Aksi</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$i = 1;
									foreach ($pembagian_hasil as $value) {
									?>
										<tr>
											<td class="center"><?= $i ?></td>
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
											<td class="center">
												<div class="action-buttons">
													<a data-rel="tooltip" data-placement="top" title="Hapus" style="margin-right:5px" class="red tooltip-error" data-toggle="modal" href="#hapus-data-<?= $value['id']; ?>">
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
											</td>
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


		<!-- Modal Tambah -->
		<div class="modal fade" id="tambah-data">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Tambah Data</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<div class="row-sm-4">
										<label class="control-label" for="tanggal">Tanggal</label>
										<input type="date" min="<?= $tahun_now[0]['tahun'] . '-' .  $bulan_now2  . '-01' ?>" max="<?= $lastDateOfMonth ?>" id="tanggal" name="tanggal" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="id_anggota">Nomor Kartu (Nama)</label>
										<select name="id_anggota" id="id_anggota" class="col-xs-12 col-sm-12" required>
											<?php
											foreach ($anggota as $a) {
											?>
												<option value="<?= $a['id_anggota'] ?>"><?= $a['no_kartu'] ?> (<?= $a['nama'] ?>)</option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id_hasil_produksi" value="<?= $id_hasil_produksi ?>">
							<input type="hidden" name="hasil_produksi" value="<?= $hasil_produksi[0]['total_hasil_produksi'] ?>">
							<input type="hidden" name="total_luas" value="<?= $total_luas[0]['luas']; ?>">
							<input type="hidden" name="id_tahun" value="<?= $id_tahun ?>">
							<input type="hidden" name="id_bulan" value="<?= $id_bulan ?>">
							<button type="submit" class="btn btn-primary" name="btn-tambah">Tambah</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<!-- End Modal Tambah -->

		<!-- Modal Hapus -->
		<?php
		foreach ($pembagian_hasil as $row) :
		?>
			<div class="modal fade" id="hapus-data-<?= $row['id']; ?>">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title"><i class="ace-icon fa fa-trash-o"> Hapus Data</i></h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="col-sm-12">
										<p>Yakin hapus data?</p>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="id_tahun" value="<?= $id_tahun ?>">
								<input type="hidden" name="id_bulan" value="<?= $id_bulan ?>">
								<button type="submit" class="btn btn-primary" name="btn-hapus" value="<?= $row['id'] ?>">Ya</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div>
		<?php endforeach; ?>
		<!-- End Modal Hapus -->

	<?php } ?>
</div><!-- /.page-content -->