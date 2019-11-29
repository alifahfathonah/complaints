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
                    <script src="<?php echo base_url();?>templates/backend/js/highchart.js"></script>
					<script src="<?php echo base_url();?>templates/backend/js/exporting.js"></script>



						<div class="table-full table-view">					
						<div class="navigation-btn">
						<form action="" method="post" id="form">
							<div class='row margin-bottom'>
								<div class='btn-search'>Cari Pengaduan per Bulan :</div>
								<div class='col-md-3 col-sm-12'>
									<div class='button-search'>
										<select type="text" value="<?php echo $month ?>" class="form-control" id="month" name="month" placeholder="Bulan"
										required/>
										<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
						</select>
									</div>
								</div>
								<div class='col-md-3 col-sm-12 select-search'>
									<select type="text" value="<?php echo $year ?>" class="form-control" id="year" name="year" placeholder="Tahun"
									required/>
									<option value="<?php echo $year ?>"><?php echo $year ?></option>
									<option value="2000">2000</option>
						<option value="2001">2001</option>
						<option value="2002">2002</option>
						<option value="2003">2003</option>
						<option value="2004">2004</option>
						<option value="2005">2005</option>
						<option value="2006">2006</option>
						<option value="2007">2007</option>
						<option value="2008">2008</option>
						<option value="2009">2009</option>
						<option value="2010">2010</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						</select>
								</div>
							</div>
							<div class='btn-navigation'>
								<div class='pull-right'>

									<button type="submit" name="kirim" class="btn btn-primary" type="button">
									<i class="fa fa-search"></i>
									</button>
									<a class="btn btn-primary" href="<?php echo site_url();?>master/laporan">
										<i class="fa fa-refresh"></i>
									</a>
								</div>
							</div>
						</form>
					</div>

					<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>
	Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
		<?php 
		$dates =  date('Y-m-d H:i:s');
		if ($this->input->post('year')) {
		$tahuns = $this->input->post('year');
	} else {
		$tahuns = substr($dates,0,4);
	}
		?>
        text: 'Laporan Total Pengaduan Per Bulan Tahun <?php echo $tahuns; ?>'
    },
    subtitle: {
        text: 'Statistik Total Pengaduan'
    },
    xAxis: {
        categories: [
			'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pengaduan'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} pcs</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Bulan',
        data: [
			<?php 
			$where_laporan['laporan_approve'] 	= 1;
			$where_laporan['laporan_status'] 	= 1;
			$januari = 0;
			$februari = 0;
			$maret = 0;
			$april = 0;
			$mei = 0;
			$juni = 0;
			$juli = 0;
			$agustus = 0;
			$september = 0;
			$oktober = 0;
			$november = 0;
			$desember = 0;
			foreach ($this->ADM->grid_all_laporan('', 'laporan_id', 'DESC', 1000, '', $where_laporan, '') as $row){ 
				
		$bulan = substr($row->laporan_created,5,2);
		$tahun = substr($row->laporan_created,0,4);
		
		if ($this->input->post('year')) {
			$tahuns = $this->input->post('year');
		} else {
			$tahuns = substr($dates,0,4);
		}

		if ($tahuns === $tahun && $bulan === '01') {
			$januari += 1;
		}
		if ($tahuns === $tahun && $bulan === '02') {
			$februari += 1;
		}
		if ($tahuns === $tahun && $bulan === '03') {
			$maret += 1;
		}
		if ($tahuns === $tahun && $bulan === '04') {
			$april += 1;
		}
		if ($tahuns === $tahun && $bulan === '05') {
			$mei += 1;
		}
		if ($tahuns === $tahun && $bulan === '06') {
			$juni += 1;
		}
		if ($tahuns === $tahun && $bulan === '07') {
			$juli += 1;
		}
		if ($tahuns === $tahun && $bulan === '08') {
			$agustus += 1;
		}
		if ($tahuns === $tahun && $bulan === '09') {
			$september += 1;
		}
		if ($tahuns === $tahun && $bulan === '10') {
			$oktober += 1;
		}
		if ($tahuns === $tahun && $bulan === '11') {
			$november += 1;
		}
		if ($tahuns === $tahun && $bulan === '12') {
			$desember += 1;
		}
		?>
		<?php } ?>
			<?php echo $januari ?>,
			<?php echo $februari ?>,
			<?php echo $maret ?>,
			<?php echo $april ?>,
			<?php echo $mei ?>,
			<?php echo $juni ?>,
			<?php echo $juli ?>,
			<?php echo $agustus ?>,
			<?php echo $september ?>,
			<?php echo $oktober ?>,
			<?php echo $november ?>,
			<?php echo $desember ?>
		]

    }]
});
</script>

					<?php if ($this->input->post('month')) {?>
					<div style="color: red; margin-bottom: 20px;" class="text-center">Pencarian Bulan : <?php echo $this->input->post('month'); ?> - Tahun : <?php echo $this->input->post('year'); ?></div>
					<?php } ?>
							<?php if ($this->input->post('laporan_bulan')) {?>
							<div style="color: red; margin-bottom: 20px;" class="text-center">Pencarian dari <?php echo dateIndo1($this->input->post('laporan_bulan').' 00:00:00'); ?> - <?php echo dateIndo1($this->input->post('laporan_tahun').' 00:00:00'); ?></div>
							<?php } ?>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
									<th width=130>No</th>
										<th>Tanggal</th>
										<th>Masyarakat</th>
										<th>Jenis Pengaduan</th>
										<th>Judul Pengaduan</th>
									</thead>
									<tbody>
										<?php 
									if ($admin->user_role === 'pejabat') { 
									$i	= $page+1;
									$where_laporan['l.laporan_status']	= 1;
									$where_laporan['l.laporan_approve']	= 1;
								} else if ($admin->user_role === 'admin') {
									$i	= $page+1;
									$where_laporan['l.laporan_status']	= 1;
								}

									if ($this->input->post('month')) {
										$month = $this->input->post('month');
										$year = $this->input->post('year');
										}
										

								if ($jml_data > 0){
									foreach ($this->ADM->grid_all_laporan2('', 'laporan_created', 'DESC', $batas, $page, $month, $year, $where_laporan, '') as $row){
									?>
										<tr>
											<td>
												<?php echo $i;?>
											</td>
											<td>
												<?php echo dateIndo1($row->laporan_created);?>
											</td>
											<td>
												<a href="<?php echo site_url();?>master/masyarakat/detail/<?php echo $row->masyarakat_username;?>"><?php echo $row->masyarakat_nama;?></a>
											</td>
											<td>
												<?php echo $row->pengaduan_jenis;?>
											</td>
											<td>
												<a href="<?php echo site_url();?>master/laporan/detail/<?php echo $row->laporan_id;?>"><?php echo $row->laporan_judul;?></a>
											</td>
										</tr>
										<?php
										$i++;
									} 
								} else {
									?>
											<tr>
												<td class="text-center" colspan="7">Belum ada data!.</td>
											</tr>
											<?php }  ?>

											<tbody>
									</tbody>
								</table>
							</div>
							<div class="wrapper">
								<div class="paging">
									<div id='pagination'>
										<div class='pagination-right'>
											<ul class="pagination">
												<?php if ($jml_halaman > 1) { echo pages($halaman, $jml_halaman, 'master/laporan/view', $id=""); }?>
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
	<?php if ($admin->user_role === 'admin') { ?>
	<?php 	if ($jml_data > 0){if ($this->input->post('year')) { 
	?>
	<a href="<?php echo site_url();?>master/laporanpdf/<?php echo $this->input->post('year'); ?>/<?php echo $this->input->post('month'); ?>">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-print" aria-hidden="true"></i>
		</button>
	</a>
	<?php } else {?>
		<a href="<?php echo site_url();?>master/laporanpdf">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-print" aria-hidden="true"></i>
		</button>
	</a>
	<?php } } }?>
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
	<a href="<?php echo site_url();?>master/laporan">
		<button class="site-action btn-raised btn btn-sm btn-floating blue" type="button">
			<i class="icon wb-eye" aria-hidden="true"></i>
		</button>
	</a>
</div>
<?php }  ?>
<!-- ================================================== END DETAIL ================================================== -->
