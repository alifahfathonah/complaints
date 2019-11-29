<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
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
						<h5 class="panel-title">View Data
							<?php echo $breadcrumb; ?>
						</h5>
					</div>
					<!-- ========== Flashdata ========== -->
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
					<!-- ========== End Flashdata ========== -->
					<div class="panel-body container-fluid table-detail">
						<div class="table-full table-view">
							<div class="navigation-btn">
								<form action="" method="post" id="form">
									<div class='row margin-bottom'>
										<div class='btn-search'>Cari Berdasarkan :</div>
										<div class='col-md-3 col-sm-12'>
											<div class='button-search'>
												<?php array_pilihan('cari', $berdasarkan, $cari);?>
											</div>
										</div>
										<div class='col-md-3 col-sm-12 select-search'>
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
									<th width=130>No Pengaduan</th>
										<th>Masyarakat</th>
										<th>Jenis</th>
										<th>Judul</th>
										<th width=200>Isi</th>
										<th>Tanggal</th>
										<th>Terakhir Diubah</th>
										<th class="text-center action">Aksi</th>
									</thead>
									<tbody>
										<?php 
									if ($admin->user_role === 'admin' || $admin->user_role === 'pejabat') { 
									$i	= $page+1;
									$like_laporan['l.pengaduan_id']			= $q;
									$where_laporan['l.laporan_status']	= 1;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_laporan('', 'laporan_created', 'DESC', $batas, $page, $where_laporan, $like_laporan) as $row){
									?>
										<tr>
											<td>
												P<?php echo $row->laporan_id;?>
											</td>
											<td>
												<a href="<?php echo site_url();?>master/masyarakat/detail/<?php echo $row->masyarakat_username;?>"><?php echo $row->masyarakat_nama;?></a>
											</td>
											<td>
												<?php echo $row->pengaduan_jenis;?>
											</td>
											<td>
												<?php echo $row->laporan_judul;?>
											</td>
											<td>
												<?php echo $row->laporan_isi;?>
											</td>
											<td>
												<?php echo dateIndo1($row->laporan_created);?>
											</td>
											<td>
												<?php echo dateIndo1($row->laporan_updated);?>
											</td>
											<td class="text-center action">
												<a class="btn-detail" href="<?php echo site_url();?>master/klarifikasi/detail/<?php echo $row->laporan_id;?>">	<i class="icon wb-info"></i></a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="10">Belum ada data!.</td>
											</tr>
											<?php } } ?>

											<tbody>
										<?php 
									if ($admin->user_role === 'user') { 
									$i	= $page+1;
									$like_laporan['l.pengaduan_id']			= $q;
									$where_laporan['l.masyarakat_username']	= $admin->username;
									$where_laporan['l.laporan_status']	= 1;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_laporan('', 'laporan_created', 'DESC', $batas, $page, $where_laporan, $like_laporan) as $row){
									?>
										<tr>
											<td>
												P<?php echo $row->laporan_id;?>
											</td>
											<td>
												<a href="<?php echo site_url();?>master/masyarakat/detail/<?php echo $row->masyarakat_username;?>"><?php echo $row->masyarakat_nama;?></a>
											</td>
											<td>
												<?php echo $row->pengaduan_jenis;?>
											</td>
											<td>
												<?php echo $row->laporan_judul;?>
											</td>
											<td>
												<?php echo $row->laporan_isi;?>
											</td>
											<td>
												<?php echo dateIndo1($row->laporan_created);?>
											</td>
											<td>
												<?php echo dateIndo1($row->laporan_updated);?>
											</td>
											<td class="text-center action">
												<a class="btn-detail" href="<?php echo site_url();?>master/klarifikasi/detail/<?php echo $row->laporan_id;?>">	<i class="icon wb-info"></i></a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="10">Belum ada data!.</td>
											</tr>
											<?php } } ?>
									</tbody>
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
												<strong>Masyarakat</strong>
											</td>
											<td>: Nama - <?php echo $laporan->masyarakat_nama;?><br>
											: No. KTP/SIM/Paspor - <?php echo $laporan->masyarakat_no;?><br>
											: Alamat - <?php echo $laporan->masyarakat_alamat;?><br>
											: Pekerjaan - <?php echo $laporan->pekerjaan_jenis;?><br>
											: No Telp - <?php echo $laporan->masyarakat_notelp;?><br>
											: Email - <?php echo $laporan->masyarakat_email;?><br>
											</td>
										</tr>
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
												<strong>Tanggal</strong>
											</td>
											<td>:
												<?php echo dateIndo1($laporan->laporan_created);?>
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
										<tr>
											<td width="200" class="title">
												<strong>Terakhir Diubah</strong>
											</td>
											<td>:
												<?php echo dateIndo($laporan->laporan_updated);?>
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
	<a href="<?php echo site_url();?>master/klarifikasi">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->

