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
							
						<?php 
								if ($admin->user_role === 'admin'){ ?>
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
												<input type="text" name="q" class="form-control" value="<?php echo $q;?>" />
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
											<a class="btn btn-primary" href="<?php echo site_url();?>master/masyarakat">
												<i class="fa fa-refresh"></i>
											</a>
										</div>
									</div>
								</form>
							</div>
								<?php } ?>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<th>No</th>
										<th>Username</th>
										<th>Nama</th>
										<th>No KTP/SIM/Paspor</th>
										<th>Email</th>
										<th>Alamat</th>
										<th>No Telp</th>
										<th>Pekerjaan</th>
										<th class="text-center">Aksi</th>
									</thead>
									<tbody>
										<?php 
								if ($admin->user_role === 'admin'){
									$i	= $page+1;
									$like_masyarakat[$cari]			= $q;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_masyarakat('', 'masyarakat_created', 'ASC', $batas, $page, '', $like_masyarakat) as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo $row->masyarakat_username;?>
											</td>
											<td>
												<?php echo $row->masyarakat_nama;?>
											</td>
											<td>
												<?php echo $row->masyarakat_no;?>
											</td>
											<td>
												<?php echo $row->masyarakat_email;?>
											</td>
											<td>
												<?php echo $row->masyarakat_alamat;?>
											</td>
											<td>
												<?php echo $row->masyarakat_notelp;?>
											</td>
											<td>
												<?php echo $row->pekerjaan_jenis;?>
											</td>
											<td class="text-center action">
												<a class="btn-detail" href="<?php echo site_url();?>master/masyarakat/detail/<?php echo $row->masyarakat_username;?>">
													<i class="icon wb-info"></i>
												</a>
												<a class="btn-delete" href="javascript:;" data-id="<?php echo $row->masyarakat_username;?>" data-toggle="modal" data-target="#modal-konfirmasi"
												title="<?php echo $row->masyarakat_nama;?>">
													<i class="icon wb-trash"></i>
												</a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="9">Belum ada data!.</td>
											</tr>
											<?php }
										} ?>
										
										<?php 
								if ($admin->user_role === 'user'){
									$i	= $page+1;
									$like_masyarakat[$cari]			= $q;
									$where_masyarakat['masyarakat_username']			= $admin->username;
								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_masyarakat('', 'masyarakat_created', 'ASC', $batas, $page, $where_masyarakat, $like_masyarakat) as $row){
									?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php echo $row->masyarakat_nama;?>
											</td>
											<td>
												<?php echo $row->masyarakat_no;?>
											</td>
											<td>
												<?php echo $row->masyarakat_username;?>
											</td>
											<td>
												<?php echo $row->masyarakat_email;?>
											</td>
											<td>
												<?php echo $row->masyarakat_alamat;?>
											</td>
											<td>
												<?php echo $row->masyarakat_notelp;?>
											</td>
											<td>
												<?php echo $row->pekerjaan_jenis;?>
											</td>
											<td class="text-center action">
												<a class="btn-detail" href="<?php echo site_url();?>master/masyarakat/edit/<?php echo $row->masyarakat_username;?>">
													<i class="icon wb-pencil"></i>
												</a>
												<a class="btn-detail" href="<?php echo site_url();?>master/masyarakat/detail/<?php echo $row->masyarakat_username;?>">
													<i class="icon wb-info"></i>
												</a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="9">Belum ada data!.</td>
											</tr>
											<?php }
										} ?>
									</tbody>
								</table>
							</div>
							<div class="wrapper">
								<div class="paging">
									<div id='pagination'>
										<div class='pagination-right'>
											<ul class="pagination">
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/masyarakat/view', $id=""); }?>
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
<!-- ========== Modal Konfirmasi ========== -->
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
				<a href="javascript:;" class="btn btn-danger" id="hapus-masyarakat">Ya</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
			</div>
		</div>
	</div>
</div>
<!-- ========== End Modal Konfirmasi ========== -->
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
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
						<h5 class="panel-title">Edit Masyarakat</h5>
					</div>
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>master/masyarakat/edit/<?php echo $masyarakat_username;?>" method="post" id="exampleStandardForm"
						autocomplete="off">
							<input type="hidden" name="masyarakat_username" value="<?php echo $masyarakat_username;?>" />
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Username</label>
								<input type="text" value="<?php echo $masyarakat_username; ?>" class="form-control input-sm" id="masyarakat_username" name="user_role"
								placeholder="Masukan Username" value="<?php echo $masyarakat_username;?>" disabled required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Password</label>
								<input type="password" class="form-control input-sm" id="masyarakat_password" name="masyarakat_password" placeholder="Masukan Password Bila diubah"
								/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Nama</label>
								<input type="text" value="<?php echo $masyarakat_nama; ?>" class="form-control input-sm" id="masyarakat_nama" name="masyarakat_nama" placeholder="Nama"
								required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">No KTP/SIM/Paspor</label>
								<input type="text" class="form-control input-sm" id="masyarakat_no" name="masyarakat_no" placeholder="No KTP/SIM/Paspor" value="<?php echo $masyarakat_no; ?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Alamat</label>
								<input type="text" class="form-control input-sm" id="masyarakat_alamat" name="masyarakat_alamat" placeholder="Alamat" value="<?php echo $masyarakat_alamat; ?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Email</label>
								<input type="text" class="form-control input-sm" id="masyarakat_email" name="masyarakat_email" placeholder="Email" value="<?php echo $masyarakat_alamat; ?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">No Telp</label>
								<input type="text" class="form-control input-sm" id="masyarakat_notelp" name="masyarakat_notelp" placeholder="No Telp" value="<?php echo $masyarakat_alamat; ?>" required/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Pekerjaan</label>
								<select type="text" class="form-control input-sm" id="pekerjaan_id" name="pekerjaan_id" placeholder="Pekerjaan" required/>
								<option value="<?php echo $pekerjaan_id; ?>"><?php echo $pekerjaan_jenis; ?></option>
								<?php 
									foreach ($this->ADM->grid_all_pekerjaan('', 'pekerjaan_created', 'DESC', 10000, '', '', '') as $row){
									?>
								<option value="<?php echo $row->pekerjaan_id;?>"><?php echo $row->pekerjaan_jenis;?></option>
								<?php } ?>
								</select>
							</div>
							<div class='button center'>
								<input class="btn btn-primary btn-sm" type="submit" name="simpan" value="Simpan Data" id="validateButton2">
								<input class="btn btn-default btn-sm" type="reset" name="batal" value="Batalkan" onclick="location.href='<?php echo site_url(); ?>master/masyarakat'"
								/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo site_url();?>master/masyarakat">
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
												<strong>Username</strong>
											</td>
											<td>:
												<strong>
													<?php echo $masyarakat->masyarakat_username;?>
												</strong>
											</td>
										</tr>
										<tr>
											<td class="title" width="250">Nama</td>
											<td>:
												<?php echo $masyarakat->masyarakat_nama;?>
											</td>
										</tr>
										<tr>
											<td class="title">No KTP/SIM/Paspor</td>
											<td>:
												<?php echo $masyarakat->masyarakat_no;?>
											</td>
										</tr>
										<tr>
											<td class="title">Email</td>
											<td>:
												<?php echo $masyarakat->masyarakat_email;?>
											</td>
										</tr>
										<tr>
											<td class="title">No Telp</td>
											<td>:
												<?php echo $masyarakat->masyarakat_notelp;?>
											</td>
										</tr>
										<tr>
											<td class="title">Alamat</td>
											<td>:
												<?php echo $masyarakat->masyarakat_alamat;?>
											</td>
										</tr>
										<tr>
											<td class="title">Pekerjaan</td>
											<td>:
												<?php echo $masyarakat->pekerjaan_jenis;?>
											</td>
										</tr>
										<tr>
											<td class="title">Dibuat</td>
											<td>:
												<?php echo dateIndo($masyarakat->pekerjaan_created);?>
											</td>
										</tr>
										<tr>
											<td class="title">Terakhir di Ubah </td>
											<td>:
												<?php echo dateIndo($masyarakat->pekerjaan_updated);?>
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
	<a href="<?php echo site_url();?>master/masyarakat/">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
