<?php
include 'functions.php';

$id_tahun = $_GET['id_tahun'];
$id_bulan = $_GET['id_bulan'];

$query_anggota = "SELECT * FROM anggota";
$anggota = tampilData($query_anggota);

$query_tahun = "SELECT * FROM tahun";
$tahun = tampilData($query_tahun);

$query_bulan = "SELECT * FROM bulan";
$bulan = tampilData($query_bulan);

$query_simpanan_wajib = "SELECT
							*
						FROM
							simpanan_wajib
						INNER JOIN anggota ON anggota.id_anggota = simpanan_wajib.id_anggota
						WHERE
							simpanan_wajib.id_tahun = '$id_tahun'
						AND simpanan_wajib.id_bulan = '$id_bulan';";

$simpanan_wajib = tampilData($query_simpanan_wajib);

$query_tahun_now = "SELECT * FROM tahun WHERE id = '$id_tahun'";
$tahun_now = tampilData($query_tahun_now);

$query_bulan_now = "SELECT * FROM bulan WHERE id = '$id_bulan'";
$bulan_now = tampilData($query_bulan_now);
$bulan_now2 = convertBulan($bulan_now[0]['bulan']);

if (isset($_POST['btn-tambah'])) {
	tambahDataSimpananWajib($_POST);
}

if (isset($_POST['btn-edit'])) {
	editDataSimpananWajib($_POST);
}

if (isset($_POST['btn-hapus'])) {
	hapusDataSimpananWajib($_POST);
}
?>


<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-file-o"></i> Simpanan Wajib Bulan <?= $bulan_now[0]['bulan']; ?> Tahun <?= $tahun_now[0]['tahun']; ?>
			<!-- <a data-toggle="modal" href="#tambah-simpanan-wajib">
				<button class="btn btn-primary pull-right">
					<i class="ace-icon fa fa-plus"></i> Tambah Simpanan Wajib
				</button>
			</a> -->
		</h1>
	</div><!-- /.page-header -->

	<!-- Modal Tambah -->
	<div class="modal fade" id="tambah-simpanan-wajib">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Tambah Simpanan Wajib</i></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="col-sm-12">
								<label class="control-label" for="no_kartu">Nomor Kartu</label>
								<select name="no_kartu" id="no_kartu" class="col-xs-12 col-sm-12" required>
									<?php
									foreach ($anggota as $a) {
									?>
										<option value="<?= $a['id_anggota'] ?>"><?= $a['no_kartu'] ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="simpanan_wajib">Simpanan Wajib</label>
								<input type="number" min="0" id="simpanan_wajib" name="simpanan_wajib" placeholder="Simpanan Wajib" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="tanggal">Tanggal</label>
								<input type="date" min="<?= $tahun_now[0]['tahun'] . '-' .  $bulan_now2  . '-01' ?>" max="<?= $tahun_now[0]['tahun'] . '-' .  $bulan_now2  . '-31' ?>" id="tanggal" name="tanggal" placeholder="Tanggal" class="col-xs-12 col-sm-12" required />
							</div>
						</div>
					</div>
					<div class="modal-footer">
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

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Data Simpanan Wajib
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
									<th>Simpanan Wajib</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$i = 1;
								foreach ($simpanan_wajib as $sw) {
								?>
									<tr>
										<td class="center"><?= $i ?></td>
										<td><?= $sw['no_kartu'] ?></td>
										<td><?= $sw['no_registrasi'] ?></td>
										<td><?= $sw['nama'] ?></td>
										<td>Rp. <?= number_format($sw['simpanan_wajib'], 2, ",", "."); ?></td>
										<td><?= $sw['tanggal'] ?></td>
										<td class="center">
											<div class="action-buttons">
												<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" data-toggle="modal" href="#edit-simpanan-wajib-<?= $sw['id']; ?>">
													<i class="ace-icon fa fa-edit bigger-130"></i>
												</a>
												<a data-rel="tooltip" data-placement="top" title="Hapus" style="margin-right:5px" class="red tooltip-error" data-toggle="modal" href="#hapus-simpanan-wajib-<?= $sw['id']; ?>">
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

	<!-- Modal Edit -->
	<?php
	foreach ($simpanan_wajib as $row) :
	?>
		<div class="modal fade" id="edit-simpanan-wajib-<?= $row['id']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Edit Simpanan Wajib</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="control-label" for="no_kartu">Nomor Kartu</label>
									<select name="no_kartu" id="no_kartu" class="col-xs-12 col-sm-12" required>
										<?php
										foreach ($anggota as $a) {
										?>
											<option value="<?= $a['id_anggota'] ?>" <?= $a['id_anggota'] == $row['id_anggota'] ? 'selected' : '' ?>><?= $a['no_kartu'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="simpanan_wajib">Simpanan Wajib</label>
									<input type="number" min="0" id="simpanan_wajib" value="<?= $row['simpanan_wajib'] ?>" name="simpanan_wajib" placeholder="Simpanan Wajib" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="tanggal">Tanggal</label>
									<input type="date" value="<?= $row['tanggal'] ?>" min="<?= $tahun_now[0]['tahun'] . '-' .  $bulan_now2  . '-01' ?>" max="<?= $tahun_now[0]['tahun'] . '-' .  $bulan_now2  . '-31' ?>" id="tanggal" name="tanggal" placeholder="Tanggal" class="col-xs-12 col-sm-12" required />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id_tahun" value="<?= $id_tahun ?>">
							<input type="hidden" name="id_bulan" value="<?= $id_bulan ?>">
							<button type="submit" class="btn btn-primary" name="btn-edit" value="<?= $row['id'] ?>">Edit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	<?php endforeach; ?>
	<!-- End Modal Edit -->

	<!-- Modal Hapus -->
	<?php
	foreach ($simpanan_wajib as $row) :
	?>
		<div class="modal fade" id="hapus-simpanan-wajib-<?= $row['id']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-trash-o"> Hapus Data Simpanan Wajib</i></h4>
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
</div><!-- /.page-content -->