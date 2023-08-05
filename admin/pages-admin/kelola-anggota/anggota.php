<?php
include 'functions.php';

$query_tampil = "SELECT
					*,
					tahun.tahun
				FROM
					anggota
				INNER JOIN tahun on tahun.id = anggota.id_tahun;";
$anggota = tampilData($query_tampil);

$query_tahun = "SELECT * FROM tahun";
$tahun = tampilData($query_tahun);

if (isset($_POST['btn-tambah'])) {
	tambahDataAnggota($_POST);
}
if (isset($_POST['btn-edit'])) {
	editDataAnggota($_POST);
}
if (isset($_POST['btn-hapus'])) {
	hapusDataAnggota($_POST);
}

?>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-users"></i> Data Anggota
			<a href="pages-admin/kelola-anggota/cetak-anggota.php" target="_blank">
				<button class="btn btn-success pull-right">
					<i class="ace-icon fa fa-print"></i> Cetak
				</button>
			</a>
			<a data-toggle="modal" href="#tambah-anggota">
				<button class="btn btn-primary pull-right">
					<i class="ace-icon fa fa-plus"></i> Tambah
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
						Data Anggota
					</div>
					<!-- div.table-responsive -->

					<div class="table-responsive">
						<!-- div.dataTables_borderWrap -->
						<div>
							<table id="dynamic-table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>No.Kartu</th>
										<th>No.Registrasi</th>
										<th>Mulai Bergabung</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>KTP</th>
										<th>Luas Plasma</th>
										<th>Foto Anggota</th>
										<th>No.Rek</th>
										<th>Bank</th>
										<th>Username</th>
										<th>Aksi</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$i = 1;
									foreach ($anggota as $row) :
									?>
										<tr>
											<td class="center"><?= $i++; ?></td>
											<td><?= $row['no_kartu']; ?></td>
											<td><?= $row['no_registrasi']; ?></td>
											<td><?= $row['tahun']; ?></td>
											<td><?= $row['nama']; ?></td>
											<td><?= $row['alamat']; ?></td>
											<td><?= $row['ktp']; ?></td>
											<td><?= $row['luas_plasma']; ?> Ha</td>
											<td class="center">
												<img src="assets-admin/images/<?= $row["foto"]; ?>" alt="foto-user" width="100px">
											</td>
											<td><?= $row['no_rek']; ?></td>
											<td><?= $row['bank']; ?></td>
											<td><?= $row['username']; ?></td>
											<td class="center">
												<div class="action-buttons">
													<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" data-toggle="modal" href="#edit-anggota-<?= $row['id_anggota']; ?>">
														<i class="ace-icon fa fa-edit bigger-130"></i>
													</a>
													<a data-rel="tooltip" data-placement="top" title="Hapus" style="margin-right:5px" class="red tooltip-error" data-toggle="modal" href="#hapus-anggota-<?= $row['id_anggota']; ?>">
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->

	<!-- Modal Tambah Anggota -->
	<div class="modal fade" id="tambah-anggota">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Tambah Anggota</i></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="col-sm-6">
								<div class="row-sm-4">
									<label class="control-label" for="no_kartu">No.Kartu</label>
									<input type="text" id="no_kartu" name="no_kartu" placeholder="No.Kartu" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="no_registrasi">No.Registrasi</label>
									<input type="text" id="no_registrasi" name="no_registrasi" placeholder="No.Registrasi" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="tahun_bergabung">Tahun Bergabung</label>
									<select name="tahun_bergabung" id="tahun_bergabung" class="col-xs-12 col-sm-12">
										<?php
										foreach ($tahun as $t) {
										?>
											<option value="<?= $t['id'] ?>"><?= $t['tahun'] ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="nama">Nama Lengkap</label>
									<input type="text" id="nama" name="nama" placeholder="Nama Lengkap" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="alamat">Alamat</label>
									<textarea name="alamat" id="alamat" cols="10" row-sm-4s="5" class="col-xs-12 col-sm-12" required></textarea>
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="ktp">KTP</label>
									<input type="text" id="ktp" name="ktp" placeholder="Nomor KTP" class="col-xs-12 col-sm-12" required />
								</div>
							</div>
							<div class="col-sm-6">
								<div class="row-sm-4">
									<label class="control-label" for="luas_plasma">Luas Plasma (Ha)</label>
									<input type="text" id="luas_plasma" name="luas_plasma" placeholder="Luas Plasma" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="foto">Pas Foto</label>
									<input type="file" id="id-input-file-2" name="foto" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="no_rek">Nomor Rekening</label>
									<input type="text" id="no_rek" name="no_rek" placeholder="Nomor rekening" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="bank">Bank</label>
									<input type="text" id="bank" name="bank" placeholder="Bank" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="username">Username Akun</label>
									<input type="text" id="username" name="username" placeholder="Username Akun" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="row-sm-4">
									<label class="control-label" for="password">Password Akun</label>
									<input type="text" id="password" name="password" placeholder="Password Akun" class="col-xs-12 col-sm-12" required />
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" name="btn-tambah">Tambah</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<!-- End Modal Tambah Anggota -->

	<!-- Modal Edit Anggota -->
	<?php
	foreach ($anggota as $row) :
	?>
		<div class="modal fade" id="edit-anggota-<?= $row['id_anggota']; ?>">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-edit"> Form Edit Anggota</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-6">
									<div class="row-sm-4">
										<label class="control-label" for="no_kartu">No.Kartu</label>
										<input type="text" id="no_kartu" name="no_kartu" value="<?= $row['no_kartu']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="no_registrasi">No.Registrasi</label>
										<input type="text" id="no_registrasi" name="no_registrasi" value="<?= $row['no_registrasi']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="tahun_bergabung">Tahun Bergabung</label>
										<select name="tahun_bergabung" id="tahun_bergabung" class="col-xs-12 col-sm-12">
											<?php
											foreach ($tahun as $t) {
											?>
												<option value="<?= $t['id'] ?>" <?= $t['tahun'] == $row['tahun'] ? 'selected' : '' ?>><?= $t['tahun'] ?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="nama">Nama Lengkap</label>
										<input type="text" id="nama" name="nama" value="<?= $row['nama']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="alamat">Alamat</label>
										<textarea name="alamat" id="alamat" cols="10" row-sm-4s="5" class="col-xs-12 col-sm-12" required><?= $row['alamat']; ?></textarea>
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="ktp">KTP</label>
										<input type="text" id="ktp" name="ktp" value="<?= $row['ktp']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row-sm-4">
										<label class="control-label" for="luas_plasma">Luas Plasma (Ha)</label>
										<input type="text" id="luas_plasma" name="luas_plasma" value="<?= $row['luas_plasma']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="foto">Pas Foto</label>
										<input type="file" id="id-input-file-2" name="foto" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="no_rek">Nomor Rekening</label>
										<input type="text" id="no_rek" name="no_rek" value="<?= $row['no_rek']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="bank">Bank</label>
										<input type="text" id="bank" name="bank" value="<?= $row['bank']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="username">Username Akun</label>
										<input type="text" id="username" name="username" value="<?= $row['username']; ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="row-sm-4">
										<label class="control-label" for="password">Password Akun</label>
										<input type="text" id="password" name="password" placeholder="Password Akun" class="col-xs-12 col-sm-12" required />
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="btn-edit" value="<?= $row['id_anggota'] ?>">Edit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	<?php endforeach; ?>
	<!-- End Edit Anggota -->

	<!-- Modal Hapus -->
	<?php
	foreach ($anggota as $row) :
	?>
		<div class="modal fade" id="hapus-anggota-<?= $row['id_anggota']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-trash-o"> Hapus Data Anggota</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<p>Yakin hapus data?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="btn-hapus" value="<?= $row['id_anggota'] ?>">Ya</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	<?php endforeach; ?>
	<!-- End Modal Hapus -->

</div><!-- /.page-content -->