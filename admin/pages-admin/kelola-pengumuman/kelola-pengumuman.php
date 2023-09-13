<?php
include 'functions.php';

$query_tampil = "SELECT * FROM pengumuman";
$pengumuman = tampilData($query_tampil);

if (isset($_POST['btn-tambah'])) {
	tambahDataPengumuman($_POST);
}

if (isset($_POST['btn-edit'])) {
	editDataPengumuman($_POST);
}

if (isset($_POST['btn-hapus'])) {
	hapusDataPengumuman($_POST);
}

if (isset($_POST['shareWA'])) {
	shareWA($_POST);
}

?>

<div class="page-content">
	<div class="page-header">
		<h1 style="color:#585858">
			<i class="ace-icon fa fa-list-alt"></i> Data Pengumuman
			<a data-toggle="modal" href="#tambah-pengumuman">
				<button class="btn btn-primary pull-right">
					<i class="ace-icon fa fa-plus"></i> Tambah Pengumuman
				</button>
			</a>
		</h1>
	</div><!-- /.page-header -->

	<!-- Modal Tambah -->
	<div class="modal fade" id="tambah-pengumuman">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><i class="ace-icon fa fa-plus"> Form Tambah Pengumuman</i></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<div class="col-sm-12">
								<label class="control-label" for="judul">Judul Pengumuman</label>
								<input type="text" id="judul" name="judul" placeholder="Judul Pengumuman" class="col-xs-12 col-sm-12" required />
							</div>
							<div class="col-sm-12">
								<label class="control-label" for="pengumuman">Isi Pengumuman</label>
								<textarea name="pengumuman" id="pengumuman" cols="10" rows="5" class="col-xs-12 col-sm-12" required></textarea>
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

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Data Pengumuman
					</div>
					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Judul</th>
									<th>Pengumuman</th>
									<th>Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$i = 1;
								foreach ($pengumuman as $value) {
								?>
									<tr>
										<td class="center"><?= $i ?></td>
										<td class="center"><?= $value['judul'] ?></td>
										<td class="center"><?= $value['pengumuman'] ?></td>
										<td class="center">
											<div class="action-buttons">
												<a data-rel="tooltip" data-placement="top" title="Ubah" style="margin-right:5px" class="blue tooltip-info" data-toggle="modal" href="#edit-pengumuman-<?= $value['id']; ?>">
													<i class="ace-icon fa fa-edit bigger-130"></i>
												</a>
												<a data-rel="tooltip" data-placement="top" title="Hapus" style="margin-right:5px" class="red tooltip-error" data-toggle="modal" href="#hapus-pengumuman-<?= $value['id']; ?>">
													<i class="ace-icon fa fa-trash-o bigger-130"></i>
												</a>
												<form method="POST">
													<button type="submit" name="shareWA" value="<?= $value['id']; ?>" style="border: none; margin-right:5px; " data-rel="tooltip" data-placement="top" title="Share WA" class="green tooltip-success" data-toggle="modal" href="#kirimWA">
														<i class="ace-icon fa fa-send-o bigger-130"></i>
													</button>
												</form>
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
	foreach ($pengumuman as $row) :
	?>
		<div class="modal fade" id="edit-pengumuman-<?= $row['id']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-edit"> Form Edit Pengumuman</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="form-group">
									<div class="col-sm-12">
										<label class="control-label" for="judul">Judul Pengumuman</label>
										<input type="text" id="judul" name="judul" placeholder="Judul Pengumuman" value="<?= $pengumuman == null ? null : $pengumuman[0]['judul'] ?>" class="col-xs-12 col-sm-12" required />
									</div>
									<div class="col-sm-12">
										<label class="control-label" for="pengumuman">Isi Pengumuman</label>
										<textarea name="pengumuman" id="pengumuman" cols="10" rows="5" class="col-xs-12 col-sm-12" required><?= $pengumuman == null ? null : $pengumuman[0]['pengumuman'] ?></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
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
	foreach ($pengumuman as $row) :
	?>
		<div class="modal fade" id="hapus-pengumuman-<?= $row['id']; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<form class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title"><i class="ace-icon fa fa-trash-o"> Hapus Data Pengumuman</i></h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<div class="col-sm-12">
									<p>Yakin hapus data?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
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