<?php
include 'functions.php';

$query_tampil = "SELECT * FROM pengurus";
$pengurus = tampilData($query_tampil);

if (isset($_POST['btn-tambah'])) {
	tambahDataPengurus($_POST);
}
if (isset($_POST['btn-edit'])) {
	editDataPengurus($_POST);
}
if (isset($_POST['btn-hapus'])) {
	hapusDataPengurus($_POST);
}

?>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-users"></i> Data Pengurus
			<a href="pages-admin/kelola-pengurus/cetak-pengurus.php" target="_blank">
			<button class="btn btn-success pull-right">
				<i class="ace-icon fa fa-print"></i> Cetak
			</button>
			</a>
			<a data-toggle="modal" href="#tambah-pengurus">
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
						Data Pengurus
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Foto Pengurus</th>
									<th>Nama Lengkap</th>
									<th>Jabatan</th>
									<th>No.HP</th>
									<th>KTP</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$i = 1;
								foreach ($pengurus as $row) :
								?>
									<tr>
										<td class="center"><?= $i++; ?></td>
										<td class="center">
											<img src="assets-admin/images/<?= $row["foto"]; ?>" alt="foto-user" width="100px">
										</td>
										<td><?= $row['nama']; ?></td>
										<td><?= $row['jabatan']; ?></td>
										<td><?= $row['no_hp']; ?></td>
										<td><?= $row['ktp']; ?></td>
										<td class="center">
											<div class="action-buttons">
												<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" data-toggle="modal" href="#edit-pengurus-<?= $row['id_pengurus']; ?>">
													<i class="ace-icon fa fa-edit bigger-130"></i>
												</a>
												<a data-rel="tooltip" data-placement="top" title="Hapus" style="margin-right:5px" class="red tooltip-error" data-toggle="modal" href="#hapus-pengurus-<?= $row['id_pengurus']; ?>">
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
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->


	<!-- Modal Tambah -->
	<div class="modal fade" id="tambah-pengurus">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Tambah Pengurus</i></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="col-sm-12">
								<label class="control-label" for="nama_lengkap">Nama Lengkap</label>
								<input type="text" id="nama_lengkap" name="nama" placeholder="Nama Lengkap" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="jabatan">Jabatan</label>
								<input type="text" id="jabatan" name="jabatan" placeholder="Jabatan" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="no_hp">No.HP</label>
								<input type="text" id="no_hp" name="no_hp" placeholder="No.HP" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="ktp">KTP</label>
								<input type="text" id="ktp" name="ktp" placeholder="KTP" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="foto">Foto</label>
								<input type="file" id="id-input-file-2" name="foto" class="col-xs-12 col-sm-12" required />
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
	<!-- End Modal Tambah -->

	<!-- Modal Edit -->
	<?php
	foreach ($pengurus as $row) :
	?>
		<div class="modal fade" id="edit-pengurus-<?= $row['id_pengurus']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-edit"> Form Edit Pengurus</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="control-label" for="nama_lengkap">Nama Lengkap</label>
									<input type="text" id="nama_lengkap" name="nama" value="<?= $row['nama']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="jabatan">Jabatan</label>
									<input type="text" id="jabatan" name="jabatan" value="<?= $row['jabatan']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="no_hp">No.HP</label>
									<input type="text" id="no_hp" name="no_hp" value="<?= $row['no_hp']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="ktp">KTP</label>
									<input type="text" id="ktp" name="ktp" value="<?= $row['ktp']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="foto">Foto</label>
									<input type="file" id="id-input-file-2" name="foto" value="<?= $row['foto']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="btn-edit" value="<?= $row['id_pengurus'] ?>">Edit</button>
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
	foreach ($pengurus as $row) :
	?>
		<div class="modal fade" id="hapus-pengurus-<?= $row['id_pengurus']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-trash-o"> Hapus Data Pengurus</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<p>Yakin hapus data?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="btn-hapus" value="<?= $row['id_pengurus'] ?>">Ya</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	<?php endforeach; ?>
	<!-- End Modal Hapus -->

</div><!-- /.page-content -->