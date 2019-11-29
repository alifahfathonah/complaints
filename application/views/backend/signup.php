<!DOCTYPE html>
<html class="no-js before-run" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

	<title>LOGIN -
		<?php echo $web->identitas_website;?>
	</title>
	<meta name="description" content="<?php echo $web->identitas_deskripsi;?>" />
	<meta name="keywords" content="<?php echo $web->identitas_keyword;?>" />
	<meta name="author" content="<?php echo $web->identitas_author;?>" />

	<link rel="apple-touch-icon" href="<?php echo base_url();?>assets/<?php echo $web->identitas_favicon;?>">
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/<?php echo $web->identitas_favicon;?>">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/bootstrap/bootstrap-extend.min.css">

	<!-- Style CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/app.css">

	<!-- Libs CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/animsition/animsition.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/asscrollable/asScrollable.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/switchery/switchery.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/intro-js/introjs.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/slidepanel/slidePanel.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/flag-icon-css/flag-icon.css">

	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/formvalidation/formValidation.css">

	<!-- Fonts -->
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/fonts/web-icons/web-icons.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/fonts/brand-icons/brand-icons.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/fonts/font-awesome/4.5.0/css/font-awesome.min.css">

	<script src="<?php echo base_url();?>templates/backend/assets/libs/jquery/jquery.js"></script>
	<!--[if lt IE 9]>
    <script src="../../<?php echo base_url();?>templates/admin/assets/libs/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

	<!--[if lt IE 10]>
    <script src="../../<?php echo base_url();?>templates/admin/assets/libs/media-match/media.match.min.js"></script>
    <script src="../../<?php echo base_url();?>templates/admin/assets/libs/respond/respond.min.js"></script>
    <![endif]-->

	<!-- Scripts -->
	<script src="<?php echo base_url();?>templates/backend/assets/libs/modernizr/modernizr.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/breakpoints/breakpoints.js"></script>

	<!-- Page -->
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/login.css">

	<!--[if lt IE 9]>
    <script src="<?php echo base_url();?>templates/backend/assets/libs/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

	<!--[if lt IE 10]>
    <script src="<?php echo base_url();?>templates/backend/assets/libs/media-match/media.match.min.js"></script>
    <script src="<?php echo base_url();?>templates/backend/assets/libs/respond/respond.min.js"></script>
    <![endif]-->

	<!-- Scripts -->
	<script src="<?php echo base_url();?>templates/backend/assets/libs/modernizr/modernizr.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/breakpoints/breakpoints.js"></script>
	<script>
		Breakpoints();

	</script>
</head>

<body class="page-login layout-full2">
	<!-- Page -->
	<div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
		<div class="page-content vertical-align-middle">
			<div class="brand">
				<img class="brand-img" style="width: 120px;" src="<?php echo base_url();?>assets/<?php echo $web->identitas_favicon;?>" alt="...">
				<h2 class="brand-text">
					Pendaftaran - Masyarakat
				</h2>
			</div>

			<form method="post" action="<?php echo site_url();?>signup/simpan" id="exampleStandardForm" autocomplete="off">
				<!-- ========== Flashdata ========== -->
				<center>
				<?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php } else if ($this->session->flashdata('warning')) { ?>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('warning'); ?>
					</div>
					<?php } else { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-warning sign"></i>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php } ?>
				<?php } ?>
				</center>
				<!-- ========== End Flashdata ========== -->
				<div class="form-group">
					<label class="sr-only" for="user">Username</label>
					<input type="text" required class="form-control" name="masyarakat_username" id="user" placeholder="Username">
				</div>
				<div class="form-group">
					<label class="sr-only" for="pass">Password</label>
					<input type="password" required class="form-control" name="masyarakat_password" id="pass" placeholder="Password">
				</div>
				<div class="form-group">
					<label class="sr-only" for="masyarakat_no">No KTP/SIM/Paspor</label>
					<input type="text" required class="form-control" name="masyarakat_no" id="masyarakat_no" placeholder="No KTP/SIM/Paspor">
				</div>
				<div class="form-group">
					<label class="sr-only" for="masyarakat_nama">Nama</label>
					<input type="text" required class="form-control" name="masyarakat_nama" id="masyarakat_nama" placeholder="Nama">
				</div>
				<div class="form-group">
					<label class="sr-only" for="masyarakat_email">Email</label>
					<input type="text" required class="form-control" name="masyarakat_email" id="masyarakat_email" placeholder="Email">
				</div>
				<div class="form-group">
					<label class="sr-only" for="masyarakat_alamat">Alamat</label>
					<input type="text" required class="form-control" name="masyarakat_alamat" id="masyarakat_alamat" placeholder="Alamat">
				</div>
				<div class="form-group">
					<label class="sr-only" for="masyarakat_notelp">No Telp</label>
					<input type="text" required class="form-control" name="masyarakat_notelp" id="masyarakat_notelp" placeholder="No Telp">
				</div>
				<div class="form-group">
					<label class="sr-only" for="pekerjaan_id">Jenis Pekerjaan</label>
					<select type="text" required class="form-control" name="pekerjaan_id" id="pekerjaan_id" placeholder="Jenis Pekerjaan">
					<option value="">Pilih Jenis Pekerjaan</option>
								<?php 
									foreach ($this->ADM->grid_all_pekerjaan('', 'pekerjaan_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->pekerjaan_id;?>">
									<?php echo $row->pekerjaan_jenis;?>
								</option>
								<?php } ?>
								</select>
				</div>
				
				
				<div class="signup"><button type="submit" class="btn btn-primary" name="masuk"  id="validateButton2">Daftar</button></div>
				
				<div class="signup2"><a href="<?php echo base_url();?>login" class="btn btn-primary">Kembali Login</a></div>
				<div class="signup2"><a href="<?php echo base_url();?>pengaduan" class="btn btn-primary">Klarifikasi Pengaduan Publik</a></div>
			</form>
			<footer class="page-copyright">
				<p>Powered by
					<?php echo $web->identitas_author;?> © 2018</p>
				<p </p>
			</footer>
		</div>
	</div>
	<!-- End Page -->

	<?php error_reporting(0); ?>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/bootstrap/bootstrap.js"></script>

	<script src="<?php echo base_url();?>templates/backend/assets/libs/animsition/jquery.animsition.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/asscroll/jquery-asScroll.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/mousewheel/jquery.mousewheel.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/asscrollable/jquery.asScrollable.all.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/ashoverscroll/jquery-asHoverScroll.js"></script>
	<!-- Plugins -->
	<script src="<?php echo base_url();?>templates/backend/assets/libs/intro-js/intro.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/screenfull/screenfull.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/slidepanel/jquery-slidePanel.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/libs/jquery-placeholder/jquery.placeholder.js"></script>


	<script src="<?php echo base_url();?>templates/backend/assets/libs/formvalidation/formValidation.min.js"></script>

	<script src="<?php echo base_url();?>templates/backend/assets/libs/formvalidation/framework/bootstrap.min.js"></script>

	<!-- Scripts -->
	<script src="<?php echo base_url();?>templates/backend/assets/js/core/core.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/site/site.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/sections/menu.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/sections/menubar.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/sections/sidebar.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/configs/config-colors.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/configs/config-tour.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/components/asscrollable.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/components/animsition.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/components/slidepanel.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/components/jquery-placeholder.js"></script>
	<script src="<?php echo base_url();?>templates/backend/assets/js/components/material.js"></script>

	<script>
		(function (document, window, $) {
			'use strict';
			var Site = window.Site;
			$(document).ready(function ($) {
				Site.run();
			});

			(function () {
				$('#exampleStandardForm').formValidation({
					framework: "bootstrap",
					button: {
						selector: '#validateButton2',
						disabled: 'disabled'
					},
					icon: null,
				});
			})();

			(function () {
				$('.summary-errors').hide()
			})();
		})(document, window, jQuery);

	</script>

</body>

</html>
