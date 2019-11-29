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
											<a class="btn btn-primary" href="<?php echo site_url();?>master/pengaduan">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
									<th width=100>No</th>
									<th width=90>No Pengaduan</th>
										<th>Masyarakat</th>
										<th>Jenis</th>
										<th>Judul</th>
										<th width=200>Isi</th>
										<th>Tanggal</th>
										<th>Terakhir Diubah</th>
										<?php 
									if ($admin->user_role === 'pejabat' || $admin->user_role === 'sekdis') {  ?>
										<th class="action text-center">Aksi</th>
									<?php } ?>
									</thead>
									<tbody>
										<?php 
									if ($admin->user_role === 'admin' || $admin->user_role === 'pejabat') { 
									$i	= $page+1;
									$like_laporan['l.pengaduan_id']			= $q;
									$where_laporan['l.laporan_status']	= 0;
									$where_laporan['l.laporan_approve']	= 1;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_laporan('', 'laporan_created', 'DESC', $batas, $page, $where_laporan, $like_laporan) as $row){
									?>
										<tr>
											<td>
												<?php echo $i;?>
											</td>
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
										<?php 
									if ($admin->user_role === 'pejabat') {  ?>
											<td class="action text-center">
												
											<a class="btn-detail" href="<?php echo site_url();?>master/pengaduan/solusi/<?php echo $row->laporan_id;?>">
													Tambah Solusi
												</a>
											</td>
									<?php }?>
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
									if ($admin->user_role === 'user' || $admin->user_role === 'sekdis') { 
									$i	= $page+1;
									$like_laporan['l.pengaduan_id']			= $q;
									$where_laporan['l.laporan_status']	= 0;
									
									if ($admin->user_role === 'sekdis') { 
									} else {
										$where_laporan['l.masyarakat_username']	= $admin->username;
									}

								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_laporan('', 'laporan_created', 'DESC', $batas, $page, $where_laporan, $like_laporan) as $row){
									?>
										<tr>
											<td>
												<?php echo $i;?>
											</td>
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
											<?php 
									if ($admin->user_role === 'sekdis') {  
										if ($row->laporan_approve == 0) {?>
											<td class="action text-center">
												
											<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->laporan_id;?>" data-toggle="modal" data-target="#modal-approve"
												title="<?php echo $row->pekerjaan_jenis;?>">
												Approve
												</a> |
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->laporan_id;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->pekerjaan_jenis;?>">
												Hapus
												</a>
											</td>
									<?php } else { ?>
											<td class="action text-center">
									Laporan sudah di Approve
											</td>
							<?php } } ?>		</tr>
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
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/pengaduan/view', $id=""); }?>
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
	<?php if ($admin->user_role === 'user') { ?>
	<a href="<?php echo site_url();?>master/pengaduan/tambah">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-plus" aria-hidden="true"></i>
		</button>
	</a>
	<?php } ?>
</div>
<!-- ========== Modal Konfirmasi ========== -->
<div id="modal-approve" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body" style="background:green;color:#fff">
				Apakah Anda yakin ingin approve data ini?
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-success" id="approve-pengaduan">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>

			<div class="modal-body" style="background:#d9534f;color:#fff">
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" id="hapus-pengaduan">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>
<!-- ========== End Modal Konfirmasi ========== --> 
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== TAMBAH ================================================== -->
<?php } elseif ($action == 'tambah') { ?>
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
						<h5 class="panel-title">Tambah Pengaduan</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/pengaduan/tambah" method="post" id="exampleStandardForm" autocomplete="off">
						<div class="form-group form-material">
								<label class="control-label" for="inputText">Jenis Pengaduan</label>
								<select type="text" class="form-control input-sm" id="pengaduan_id" name="pengaduan_id" placeholder="Pengaduan" required/>
								<option value=""></option>
								<?php 
									foreach ($this->ADM->grid_all_pengaduan('', 'pengaduan_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->pengaduan_id;?>"><?php echo $row->pengaduan_jenis;?></option>
								<?php } ?>
								</select>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Judul Pengaduan</label>
								<input type="text" class="form-control input-sm" id="laporan_judul" name="laporan_judul" placeholder="Nama Pengaduan" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Isi Pengaduan</label>
								<textarea type="text" class="" id="laporan_isi" name="laporan_isi" placeholder="Isi Pengaduan" style="height:175px; width: 100%;" required/></textarea>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/pengaduan'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/pengaduan">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<!-- ================================================== END TAMBAH ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'solusi') { ?>
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
						<h5 class="panel-title">Tambah Solusi</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/pengaduan/solusi/<?php echo $laporan_id;?>" method="post" id="exampleStandardForm"
						autocomplete="off">
							<input type="hidden" name="laporan_id" value="<?php echo $laporan_id;?>" />
							<div class="form-group form-material">
								<label class="control-label" for="inputText">No Pengaduan</label>
								<input type="text" value="<?php echo $laporan_id; ?>" class="form-control input-sm" id="laporan_id" name="laporan_id"
								placeholder="Masukan No Pengaduan" value="<?php echo $laporan_id;?>" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Judul</label>
								<input type="text" value="<?php echo $laporan_judul; ?>" class="form-control input-sm" id="laporan_judul" name="laporan_judul"
								placeholder="Masukan Judul" value="<?php echo $laporan_judul;?>" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Masalah</label>
								<textarea type="text" value="<?php echo $laporan_isi; ?>" class="form-control input-sm" id="laporan_isi" style="height:175px" name="laporan_isi"
								placeholder="Masukan Masalah" disabled required/><?php echo $laporan_isi;?></textarea>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Solusi Masalah</label>
								<textarea type="text" class="input-sm" id="laporan_solusi" name="laporan_solusi" style="height:175px; width: 100%;" placeholder="Masukan Solusi Masalah" required></textarea>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Kirim Solusi" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/pengaduan'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/pengaduan">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<!-- ================================================== END EDIT ================================================== -->

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
											<td class="title">
												<strong>No Pengaduan</strong>
											</td>
											<td>:
												<strong>
													P<?php echo $pengaduan->laporan_id;?>
												</strong>
											</td>
										</tr>
										<tr>
											<td class="title" width="150">Nama Pengaduan</td>
											<td>:
												<?php echo $pengaduan->laporan_judul;?>
											</td>
										</tr>
										<tr>
											<td class="title" width="150">Pengaduan Alamat</td>
											<td>:
												<?php echo $pengaduan->laporan_isi;?>
											</td>
										</tr>
										<tr>
											<td class="title">Dibuat</td>
											<td>:
												<?php echo dateIndo($pengaduan->pengaduan_created);?>
											</td>
										</tr>
										<tr>
											<td class="title">Terakhir di Ubah </td>
											<td>:
												<?php echo dateIndo($pengaduan->pengaduan_updated);?>
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
	<a href="<?php echo site_url();?>master/pengaduan/">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
