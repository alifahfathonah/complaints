<!DOCTYPE html>
<html>

<head>
	<title></title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin: 0 auto;
			font-size: 14px;
		}

		table th {
			border: 1px solid #000;
			padding: 3px;
			font-weight: bold;
			text-align: center;
		}

		table td {
			border: 1px solid #000;
			padding: 7px;
			vertical-align: top;
		}

		table thead tr {
			color: #fff;
			background: #039BE5;
		}

		table tbody tr td {
			color: #000;
			background: #efebe9;
		}

		table tbody tr th {
			color: #000;
			background: #efebe9;
		}

		h3 {
			text-align: center;
			font-weight: 400;
			font-size: 16px;
		}

		h3.satu {
			text-transform: uppercase;
		}

		h3.dua {
			text-transform: uppercase;
		}

		h3.tiga {
        }
	</style>
</head>

<body>
	
<h3 class="satu">Laporan Pengaduan</h3>
	<h3 class="dua">Dinas Pendidikan Pemerintah Daerah Provinsi Jawa Barat</h3>
	<h3 class="tiga"><?php 
									if ($filter1) { ?>
									Bulan : <?php echo $filter2 ?> - Tahun : <?php echo $filter1 ?>
										<?php } else { ?>
											Keseluruhan
											<?php } ?></h3>
	<br>
	<br>
	<table>
		<thead>
			<tr>
				<th width="7%">No</th>
				<th width="13%">Tanggal</th>
				<th width="25%">Masyarakat</th>
				<th width="15%">Jenis Pengaduan</th>
				<th width="40%">Pengaduan</th>
			</tr>
		</thead>
		<?php 
									$i	= 1;
									
									if ($filter1) {
										$month = $filter2;
										$year = $filter1;
										} else {
										$month =  '';
										$year = '';
										}

										$where_laporan['laporan_status']	= 1;
										$where_laporan['laporan_approve']	= 1;
									foreach ($this->ADM->grid_all_laporan2('', 'laporan_created', 'DESC', 10000, '', $month, $year, $where_laporan, '') as $row){
									?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo dateIndo1($row->laporan_created) ?></td>
			<td>
				Nama : <?php echo $row->masyarakat_nama ?><br>
				No. KTP/SIM/Paspor : <?php echo $row->masyarakat_no ?><br>
				Pekerjaan : <?php echo $row->pekerjaan_jenis ?><br>
				Alamat : <?php echo $row->masyarakat_alamat ?><br>
				No Telp : <?php echo $row->masyarakat_notelp ?><br>
				Email : <?php echo $row->masyarakat_email ?><br>
			</td>
			<td><?php echo $row->pengaduan_jenis ?></td>
			<td>Judul : <br> <?php echo $row->laporan_judul ?><br><br>
			Isi : <br> <?php echo $row->laporan_isi ?><br><br>
			Solusi : <br> <?php echo $row->laporan_solusi ?></td>
		</tr>
		<?php 
										$i++;
										 } ?>
	</table>
</body>

</html>
