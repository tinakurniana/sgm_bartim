<?php
// mematikan semua error reporting
error_reporting(0);

// memulai eksekusi session (mengaktifkan session)
session_start();

// mengkonekkan ke file functions-admin.php
include 'function-show.php';

$username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
$password = mysqli_real_escape_string($conn, htmlspecialchars(md5($_POST['password'])));

if (isset($_POST['login'])) {
	if ($_POST['role'] == 'admin') {
		$data = tampilData("SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
		if (count($data) > 0) {
			$_SESSION['loginAdmin'] = 'login';
			$_SESSION['idAdmin'] = $data[0]['id_admin'];
			echo '<script>
				alert("Login Berhasil");
				location.href = "admin/indexAdmin.php?p=beranda&m=beranda";
			</script>';
		} else {
			echo '<script>
				alert("Login Gagal");
				location.href = "login.php";
			</script>';
		}
	} else {
		$data = tampilData("SELECT * FROM anggota WHERE username = '$username' AND password = '$password'");
		if (count($data) > 0) {
			$_SESSION['loginAnggota'] = 'login';
			$_SESSION['name'] = $data[0]['nama'];
			$_SESSION['id'] = $data[0]['id_anggota'];
			echo '<script>
				alert("Login Berhasil");
				location.href = "anggota/indexAnggota.php?p=beranda&m=beranda";
			</script>';
		} else {
			echo '<script>
				alert("Login Gagal");
				location.href = "login.php";
			</script>';
		}
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>Login Admin</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<meta name="description" content="Sistem Informasi Koperasi Plasma PT Sawit Graha Manunggal" />
	<meta name="author" content="PT Sawit Graha Manunggal" />

	<!-- favicon -->
	<link rel="shortcut icon" href="admin/assets-admin/img/favicon.png">

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" type="text/css" href="admin/assets-admin/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="admin/assets-admin/plugins/font-awesome-4.6.3/css/font-awesome.min.css" />

	<!--fonts-->
	<link rel="stylesheet" type="text/css" href="admin/assets-admin/fonts/fonts.googleapis.com.css" />

	<!--ace styles-->
	<link rel="stylesheet" type="text/css" href="admin/assets-admin/css/ace.min.css" />
	<link rel="stylesheet" type="text/css" href="admin/assets-admin/css/ace-rtl.min.css" />
</head>

<body class="login-layout">
	<div class="main-container">
		<div class="main-content">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="login-container">

						<div class="space-20"></div>
						<div class="space-20"></div>
						<div class="space-20"></div>
						<div class="space-20"></div>
						<div class="position-relative">
							<div id="login-box" class="login-box visible widget-box no-border">
								<div class="widget-body">
									<div class="widget-main">
										<h4 style="font-size:20px" class="header lighter bigger">
											<i style="color:#777" class="ace-icon fa fa-user"></i>
											Silahkan Login
										</h4>

										<div class="space-6"></div>

										<form action="" method="POST">
											<fieldset>
												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<select class="form-control" name="role" id="form-field-select-1">
															<option value="admin">Admin</option>
															<option value="anggota">Anggota</option>
														</select>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
														<i class="ace-icon fa fa-user"></i>
													</span>
												</label>

												<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required />
														<i class="ace-icon fa fa-lock"></i>
													</span>
												</label>

												<div class="space"></div>

												<div class="clearfix">
													<button style="font-size:15px" name="login" type="submit" class="btn btn-primary btn-block">
														<i class="ace-icon fa fa-key"></i>
														<span class="bigger-110">Login</span>
													</button>
												</div>

												<div class="space-4"></div>
											</fieldset>
										</form>
									</div><!-- /.widget-main -->
								</div><!-- /.widget-body -->
							</div><!-- /.login-box -->
						</div><!-- /.position-relative -->
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.main-content -->
	</div><!-- /.main-container -->

	<!--basic scripts-->

	<!--[if !IE]> -->
	<script src="admin/assets-admin/js/jquery.2.1.1.min.js"></script>
	<!-- <![endif]-->

	<!--[if !IE]> -->
	<script type="text/javascript">
		window.jQuery || document.write("<script src='admin/assets-admin/js/jquery.min.js'>" + "<" + "/script>");
	</script>
	<!-- <![endif]-->

	<script type="text/javascript">
		if ('ontouchstart' in document.documentElement) document.write("<script src='admin/assets-admin/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
	</script>

	<script src="admin/assets-admin/js/bootstrap.min.js"></script>

	<!--inline scripts related to this page-->
	<script type="text/javascript">
		jQuery(function($) {
			$(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible'); //hide others
				$(target).addClass('visible'); //show target
			});
		});
	</script>
</body>

</html>