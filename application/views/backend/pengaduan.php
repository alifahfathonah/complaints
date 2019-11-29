<!-- ================================================== VIEW ================================================== -->
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html class="no-js before-run" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title>ADMINISTRATOR -
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
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/style.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/css/app.css">

	<!-- Libs CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/animsition/animsition.css">
	<link rel="stylesheet" href="<?php echo base_url();?>templates/backend/assets/libs/asscrollable/asScrollable.css">
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
	<script>
		Breakpoints();

	</script>

</head>

<body class="page-login layout-full2">
	<!-- Page -->
	<div class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
		<div class="page-content vertical-align-middle">
			<div class="brand">
				<h2 class="brand-text">
					Klarifikasi Pengaduan Publik
				</h2>
			</div>

<?php if ($action == 'view' || empty($action)){ ?>

					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-view">
							<div class="navigation-btn">
								<form action="" method="post" id="form">
									<div class='row margin-bottom'>
										<div class='btn-search'>Cari Berdasarkan :</div>
										<div class='col-md-4 col-sm-12'>
											<div class='button-search'>
												<?php array_pilihan('cari', $berdasarkan, $cari);?>
											</div>
										</div>
										<div class='col-md-4 col-sm-12 select-search'>
											<div class="input-group">
												
								<select type="text" class="form-control" id="q" name="q" placeholder="Jenis Pengaduan"/>
								<option value=""></option>
								<?php 
									foreach ($this->ADM->grid_all_pengaduan('', 'pengaduan_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->pengaduan_id;?>"><?php echo $row->pengaduan_jenis;?></option>
								<?php } ?>
								</select>
												<span class="input-group-btn">
													<button type="submit" name="kirim" class="btn btn-primary" type="button">
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class='btn-navigation'>
										<div class='pull-right'>
											<a class="btn btn-primary" href="<?php echo site_url();?>master/klarifikasi">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th class="text-center action">Jenis</th>
										<th class="text-center action">Judul</th>
										<th class="text-center action" width=200>Isi</th>
										<th class="text-center action">Aksi</th>
									</thead>
									<tbody>
										<?php 
									$i	= $page+1;
									$like_laporan['l.pengaduan_id']			= $q;
									$where_laporan['l.laporan_status']	= 1;
									$where_laporan['l.laporan_approve']	= 1;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_laporan('', 'laporan_created', 'DESC', $batas, $page, $where_laporan, $like_laporan) as $row){
									?>
										<tr>
											<td>
												<?php echo $row->pengaduan_jenis;?>
											</td>
											<td>
												<?php echo $row->laporan_judul;?>
											</td>
											<td>
												<?php echo $row->laporan_isi;?>
											</td>
											<td class="text-center action">
												<a class="btn-detail" href="<?php echo site_url();?>pengaduan/detail/<?php echo $row->laporan_id;?>">	<i class="icon wb-info"></i></a>
											</td>
										</tr>
										<?php
										$i++;
								} }
									?>
											<tr>
												<td class="text-center" colspan="10">Belum ada data!.</td>
											</tr>
											
								</table>
							</div>
							<div class="wrapper">
								<div class="paging">
									<div id='pagination'>
										<div class='pagination-right'>
											<ul class="pagination">
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/klarifikasi/view', $id=""); }?>
											</ul>
										</div>
									</div>
								</div>
								<div class="total">Total :
									<?php echo $jml_data;?>
								</div>
							</div>
						</div>
				<div class="signup" style="margin-bottom: 5px"><button type="submit" class="btn btn-primary" name="masuk"  id="validateButton2">Daftar</button></div>
				
				<div class="signup2"><a href="<?php echo base_url();?>login" class="btn btn-primary">Kembali Login</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== DETAIL ================================================== -->
<?php } elseif ($action == 'detail') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Informasi Mengenai
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Detail
							<?php echo $breadcrumb; ?>
						</h5>
					</div>
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-detail">
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<tr>
											<td width="200" class="title">
												<strong>Jenis Pengaduan</strong>
											</td>
											<td>:
												<?php echo $laporan->pengaduan_jenis;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Judul</strong>
											</td>
											<td>:
												<?php echo $laporan->laporan_judul;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Isi</strong>
											</td>
											<td>:
												<?php echo $laporan->laporan_isi;?>
											</td>
										</tr>
										<tr>
											<td width="200" class="title">
												<strong>Solusi</strong>
											</td>
											<td>:
												<?php echo $laporan->laporan_solusi;?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>pengaduan">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->

	<script>
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget)
			var id = div.data('id')
			var modal = $(this)
			modal.find('#hapus-pekerjaan').attr("href", "<?php echo site_url();?>kategori/pekerjaan/hapus/" + id);
			modal.find('#hapus-kategoripengaduan').attr("href", "<?php echo site_url();?>kategori/pengaduan/hapus/" + id);
			modal.find('#hapus-masyarakat').attr("href", "<?php echo site_url();?>master/masyarakat/hapus/" + id);
			modal.find('#hapus-pengaduan').attr("href", "<?php echo site_url();?>master/pengaduan/hapus/" + id);
			modal.find('#hapus-user').attr("href", "<?php echo site_url();?>akun/user/hapus/" + id);
		});

	</script>

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


