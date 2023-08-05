<?php
include 'functions.php';

$query_tampil = "SELECT * FROM galeri";
$galeri = tampilData($query_tampil);

if (isset($_POST['btn-tambah'])) {
	tambahDataGaleri($_POST);
}
if (isset($_POST['btn-edit'])) {
	editDataGaleri($_POST);
}
if (isset($_POST['btn-hapus'])) {
	hapusDataGaleri($_POST);
}
?>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-desktop"></i> Kelola Galeri Halaman Pengunjung
			<a data-toggle="modal" href="#tambah-galeri">
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
						Kelola Galeri Halaman Pengunjung
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Foto</th>
									<th>Judul</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$i = 1;
								foreach ($galeri as $row) :
								?>
									<tr>
										<td class="center"><?= $i++; ?></td>
										<td class="center">
											<img src="assets-admin/images/<?= $row["foto"]; ?>" alt="foto-user" width="100px">
										</td>
										<td><?= $row['judul']; ?></td>
										<td><?= $row['keterangan']; ?></td>
										<td class="center">
											<div class="action-buttons">
												<div class="action-buttons">
													<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" data-toggle="modal" href="#edit-galeri-<?= $row['id_galeri']; ?>">
														<i class="ace-icon fa fa-edit bigger-130"></i>
													</a>
													<a data-rel="tooltip" data-placement="top" title="Hapus" style="margin-right:5px" class="red tooltip-error" data-toggle="modal" href="#hapus-galeri-<?= $row['id_galeri']; ?>">
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
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
	<div class="modal fade" id="tambah-galeri">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Tambah Galeri</i></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="col-sm-12">
								<label class="control-label" for="foto">Foto</label>
								<input type="file" id="id-input-file-2" name="foto" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="judul">Judul</label>
								<input type="text" id="judul" name="judul" placeholder="Judul" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<br>
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="keterangan">Keterangan</label>
								<textarea name="keterangan" id="keterangan" cols="10" rows="5" class="col-xs-12 col-sm-12" required></textarea>
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
	foreach ($galeri as $row) :
	?>
		<div class="modal fade" id="edit-galeri-<?= $row['id_galeri']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-edit"> Form Edit Galeri</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<label class="control-label" for="foto">Foto</label>
									<input type="file" id="id-input-file-2" name="foto" value="<?= $row['foto']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="judul">Judul</label>
									<input type="text" id="judul" name="judul" value="<?= $row['judul']; ?>" class="col-xs-12 col-sm-12" required />
								</div>
								<div class="col-sm-12">
									<br>
								</div>
								<div class="col-sm-12">
									<label class="control-label" for="keterangan">Keterangan</label>
									<textarea name="keterangan" id="keterangan" cols="10" rows="5" class="col-xs-12 col-sm-12" required><?= $row['keterangan']; ?></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="btn-edit" value="<?= $row['id_galeri'] ?>">Edit</button>
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
	foreach ($galeri as $row) :
	?>
		<div class="modal fade" id="hapus-galeri-<?= $row['id_galeri']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-trash-o"> Hapus Data Galeri</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<p>Yakin hapus data?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" name="btn-hapus" value="<?= $row['id_galeri'] ?>">Ya</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
	<?php endforeach; ?>
	<!-- End Modal Hapus -->
</div><!-- /.page-content -->