<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
    }

	public function index()
	{
		if($this->session->userdata('sign_in') == TRUE){
			$where_admin['username']		= $this->session->userdata('username');
			$data['admin']					= $this->ADM->get_admin('',$where_admin);
			redirect("master/pengaduan");
		} else {
			redirect("login");
		}
	 }
	
	//FUNCTION Masyarakat
	public function masyarakat($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'user' || $data['admin']->user_role === 'pejabat') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Masyarakat';
				$data['content'] 			= 'backend/content/master/masyarakat';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('masyarakat_username'=>'Username',
														'masyarakat_nama'=>'Nama');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'masyarakat_nama';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_masyarakat[$data['cari']]	= $data['q'];
					$where_masyarakat['masyarakat_username'] = $data['admin']->username;
					if ($data['admin']->user_role === 'user') {
					$data['jml_data']			= $this->ADM->count_all_masyarakat($where_masyarakat, $like_masyarakat);
					} else {
					$data['jml_data']			= $this->ADM->count_all_masyarakat('', $like_masyarakat);
					}
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'edit'){		
					if ($data['admin']->user_role === 'user') {
						$where['username']		       = $filter2; 
							$data['validate']			= array('masyarakat_username'=>'Username',
																'masyarakat_password'=>'Password',
																'masyarakat_nama'=>'Nama',
																'masyarakat_alamat'=>'Alamat',
																'masyarakat_notelp'=>'No Telp',
																'masyarakat_email'=>'Email',
																'masyarakat_no'=>'No KTP/SIM/Paspor',
																'pekerjaan_id'=>'ID Pekerjaan'
																	);
						$data['onload']					= 'masyarakat_username';
						$where_masyarakat['masyarakat_username']		= $filter2; 
						$masyarakat							= $this->ADM->get_masyarakat('*', $where_masyarakat);
						$data['masyarakat_username']	= ($this->input->post('masyarakat_username'))?$this->input->post('masyarakat_username'):$masyarakat->masyarakat_username;
						$data['masyarakat_password']	= ($this->input->post('masyarakat_password'))?$this->input->post('masyarakat_password'):'';
						$data['masyarakat_nama']	= ($this->input->post('masyarakat_nama'))?$this->input->post('masyarakat_nama'):$masyarakat->masyarakat_nama;
						$data['masyarakat_alamat']	= ($this->input->post('masyarakat_alamat'))?$this->input->post('masyarakat_alamat'):$masyarakat->masyarakat_alamat;
						$data['masyarakat_notelp']	= ($this->input->post('masyarakat_notelp'))?$this->input->post('masyarakat_notelp'):$masyarakat->masyarakat_notelp;
						$data['masyarakat_email']	= ($this->input->post('masyarakat_email'))?$this->input->post('masyarakat_email'):$masyarakat->masyarakat_email;
						$data['masyarakat_no']	= ($this->input->post('masyarakat_no'))?$this->input->post('masyarakat_no'):$masyarakat->masyarakat_no;
						$data['pekerjaan_id']	= ($this->input->post('pekerjaan_id'))?$this->input->post('pekerjaan_id'):$masyarakat->pekerjaan_id;
						$data['pekerjaan_jenis']	= ($this->input->post('pekerjaan_jenis'))?$this->input->post('pekerjaan_jenis'):$masyarakat->pekerjaan_jenis;
						$simpan							= $this->input->post('simpan');
						if ($simpan){
							$where_edit['username']	= validasi_sql($data['masyarakat_username']);
							if ($data['masyarakat_password'] <> '') {						
							$edit['password']			= validasi_sql(do_hash(($data['masyarakat_password']), 'md5')); }
							$edit['user_nama']			= validasi_sql($data['masyarakat_nama']);
							$this->ADM->update_admin($where_edit, $edit);
	
							$where_edit2['masyarakat_username']	= validasi_sql($data['masyarakat_username']);
							if ($data['masyarakat_password'] <> '') {						
							$edit2['masyarakat_password']			= validasi_sql(do_hash(($data['masyarakat_password']), 'md5')); }
							$edit2['masyarakat_nama']			= validasi_sql($data['masyarakat_nama']);
							$edit2['masyarakat_alamat']			= validasi_sql($data['masyarakat_alamat']);
							$edit2['masyarakat_notelp']			= validasi_sql($data['masyarakat_notelp']);
							$edit2['masyarakat_email']			= validasi_sql($data['masyarakat_email']);
							$edit2['masyarakat_no']			= validasi_sql($data['masyarakat_no']);
							$edit2['pekerjaan_id']			= validasi_sql($data['pekerjaan_id']);
							$this->ADM->update_masyarakat($where_edit2, $edit2);
	
							$this->session->set_flashdata('success','Masyarakat telah berhasil diedit!,');
							redirect("master/masyarakat");
						}
					} else {
						redirect("master/masyarakat");
					}
				} elseif ($data['action'] == 'detail'){		
					if ($data['admin']->user_role === 'user') {
						if ($data['admin']->username === $filter2) {
						$data['onload']					= 'masyarakat_username';
						$where_masyarakat['masyarakat_username']		        = $filter2; 
						$data['masyarakat']							= $this->ADM->get_masyarakat('*', $where_masyarakat);
						} else {
							redirect("master/masyarakat");
						}
					} else {
						$data['onload']					= 'masyarakat_username';
						$where_masyarakat['masyarakat_username']		        = $filter2; 
						$data['masyarakat']							= $this->ADM->get_masyarakat('*', $where_masyarakat);
					}
				} elseif ($data['action'] == 'hapus'){		
					if ($data['admin']->user_role === 'admin') {
						$where_delete['masyarakat_username'] = validasi_sql($filter2);
						$this->ADM->delete_masyarakat($where_delete);
						$where_delete2['username'] = validasi_sql($filter2);
						$this->ADM->delete_admin($where_delete2);
						$this->session->set_flashdata('warning','Masyarakat telah berhasil dihapus!,');
						redirect("master/masyarakat");
					} else {
						redirect("master/masyarakat");
					}
				}
			} else {
				redirect("master/pengaduan");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Masyarakat ================================================== //

	//FUNCTION Pengaduan
	public function pengaduan($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'pejabat' || $data['admin']->user_role === 'user' || $data['admin']->user_role === 'sekdis' ) {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Pengaduan';
				$data['content'] 			= 'backend/content/master/pengaduan';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('pengaduan_id'=>'Jenis Pengaduan');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pengaduan_id';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_laporan[$data['cari']]	= $data['q'];
					if ($data['admin']->user_role === 'user') {
						$where_laporan['masyarakat_username']	= $data['admin']->username;
						$data['jml_data']			= $this->ADM->count_all_laporan($where_laporan, $like_laporan);
						$where_laporan['laporan_status']	= 0;
					} else if ($data['admin']->user_role === 'pejabat') {
						$where_laporan['laporan_status']	= 0;
						$where_laporan['laporan_approve']	= 1;
						$data['jml_data']			= $this->ADM->count_all_laporan($where_laporan, $like_laporan);
					} else if ($data['admin']->user_role === 'admin') {
						$where_laporan['laporan_status']	= 0;
						$where_laporan['laporan_approve']	= 1;
						$data['jml_data']			= $this->ADM->count_all_laporan($where_laporan, $like_laporan);
					} else if ($data['admin']->user_role === 'sekdis') {
						$data['jml_data']			= $this->ADM->count_all_laporan('', $like_laporan);
					}

					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					if ($data['admin']->user_role === 'user') {
						$data['validate']			= array('laporan_judul'=>'Judul',
														'laporan_isi'=>'Isi',
														'pengaduan_id'=>'Jenis Pengaduan'
													);
						$data['onload']				= 'laporan_id';
						$data['laporan_judul']			= ($this->input->post('laporan_judul'))?$this->input->post('laporan_judul'):'';
						$data['laporan_isi']		= ($this->input->post('laporan_isi'))?$this->input->post('laporan_isi'):'';		
						$data['pengaduan_id']		= ($this->input->post('pengaduan_id'))?$this->input->post('pengaduan_id'):'';		
						
						$simpan						= $this->input->post('simpan');
						if ($simpan){								
							$insert['laporan_judul']	= validasi_sql($data['laporan_judul']);
							$insert['laporan_isi']		= validasi_sql($data['laporan_isi']);
							$insert['pengaduan_id']		= validasi_sql($data['pengaduan_id']);
							$insert['masyarakat_username']		= $data['admin']->username;
							$this->ADM->insert_laporan($insert);
							$this->session->set_flashdata('success','Pengaduan baru telah berhasil ditambahkan!,');
							redirect("master/pengaduan");
						}
					} else {
						redirect("master/pengaduan");
					}
				} elseif ($data['action'] == 'solusi'){	
					if ($data['admin']->user_role === 'pejabat') {			
						$where['laporan_id']		       = $filter2; 
						$data['validate']				= array('laporan_id'=>'No Pengaduan',
															'laporan_solusi'=>'Solusi');
						$data['onload']					= 'laporan_id';
						$where_laporan['laporan_id']			= $filter2; 
						$laporan							= $this->ADM->get_laporan('*', $where_laporan);
						if ($laporan->laporan_status === '0') {	
							$data['laporan_id']					= ($this->input->post('laporan_id'))?$this->input->post('laporan_id'):$laporan->laporan_id;
							$data['laporan_judul']				= ($this->input->post('laporan_judul'))?$this->input->post('laporan_judul'):$laporan->laporan_judul;	
							$data['laporan_isi']				= ($this->input->post('laporan_isi'))?$this->input->post('laporan_isi'):$laporan->laporan_isi;	
							$data['laporan_solusi']				= ($this->input->post('laporan_solusi'))?$this->input->post('laporan_solusi'):'';	
							$simpan							= $this->input->post('simpan');
							if ($simpan){
								$where_edit['laporan_id']		= $filter2; 
								$edit['laporan_solusi']			= validasi_sql($data['laporan_solusi']);
								$edit['laporan_status']			= 1;
								$this->ADM->update_laporan($where_edit, $edit);
								$this->session->set_flashdata('success','Pengaduan berhasil di verifikasi!,');
								redirect("master/klarifikasi");
							}
						} else {
							redirect("master/pengaduan");
						}
					} else {
						redirect("master/pengaduan");
					}
				} elseif ($data['action'] == 'approve'){	
					if ($data['admin']->user_role === 'sekdis') {			
						$where_edit['laporan_id']		= $filter2; 
						$edit['laporan_approve']			= 1;
						$this->ADM->update_laporan($where_edit, $edit);
						$this->session->set_flashdata('success','Pengaduan berhasil di approve!,');
						redirect("master/pengaduan");
					} else {
						redirect("master/pengaduan");
					}
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['laporan_id'] = validasi_sql($filter2);
					$this->ADM->delete_laporan($where_delete);
					$this->session->set_flashdata('warning','Pengaduan telah berhasil dihapus!,');
					redirect("master/pengaduan");
				}
			} else {
				redirect("master/pengaduan");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Pengaduan ================================================== //
	
	//FUNCTION Klarifikasi
	public function klarifikasi($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'pejabat' || $data['admin']->user_role === 'user' || $data['admin']->user_role === 'sekdis' ) {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Klarifikasi Pengaduan';
				$data['content'] 			= 'backend/content/master/klarifikasi';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('pengaduan_id'=>'Jenis Pengaduan');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pengaduan_id';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_laporan[$data['cari']]	= $data['q'];
					if ($data['admin']->user_role === 'user') {
						$where_laporan['masyarakat_username']	= $data['admin']->username;
						$where_laporan['laporan_status']	= 1;
					} else {
						$where_laporan['laporan_status']	= 1;
					}
					$data['jml_data']			= $this->ADM->count_all_laporan($where_laporan, $like_laporan);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				}  elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'laporan_id';
					$where_laporan['laporan_id']		        = $filter2; 
					$data['laporan']							= $this->ADM->get_laporan('*', $where_laporan);
				}
			} else {
				redirect("master/pengaduan");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Klarifikasi ================================================== //

	//FUNCTION Laporan
	public function laporan($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin' || $data['admin']->user_role === 'pejabat') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Laporan';
				$data['content'] 			= 'backend/content/master/laporan';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['month'] ="";
					$data['year'] ="";
					$month = "";
					$year ="2018";
					$data['year'] ="2018";
					$data['kirim']				= $this->input->post('kirim');
					if ($this->input->post('month')) {
						$month = $this->input->post('month');
						$year = $this->input->post('year');
					}
					
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					
				
					if ($data['admin']->user_role === 'pejabat') { 
						$where_laporan['laporan_status']	= 1;
						$where_laporan['laporan_approve']	= 1;
					} else if ($data['admin']->user_role === 'admin') { 
						$where_laporan['laporan_status']	= 1;
					}

					$data['jml_data']			= $this->ADM->count_all_laporan2($month, $year, $where_laporan, '');
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'laporan_id';
					$where_laporan['laporan_id']		        = $filter2; 
					$data['laporan']							= $this->ADM->get_laporan('*', $where_laporan);
					if ($data['laporan']->laporan_status === 0) {
						redirect("master/laporan");
					}
				}
			} else {
				redirect("master/pengaduan");
			}
			$this->load->vars($data);
			$this->load->view('backend/home');
		} else {
			redirect("login");
		}
	}
	// ================================================== END Laporan ================================================== //

	public function laporanpdf($filter1='', $filter2='', $filter3=''){
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin') {
				$data['web']				= $this->ADM->identitaswebsite();
				$data['title'] = 'Cetak Laporan Pengaduan'; 

				if ($filter1) {
					$data['filter1']	        = $filter1; 
					$data['filter2']	        = $filter2; 
					$data['month']	        = $filter1; 
					$data['year']	        = $filter2; 
					$this->load->view('backend/content/master/pdf/laporan', $data);
					$paper_size  = 'A4'; 
					$orientation = 'potrait'; 
					$html = $this->output->get_output();
					def("DOMPDF_ENABLE_REMOTE", false);
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("laporanpengaduan-".$filter2."-".$filter1.".pdf", array('Attachment'=>0));
				} else {
					$data['filter1']	        = ''; 
					$data['filter2']	        = ''; 
					$data['month']	        = ''; 
					$data['year']	        = ''; 
					$this->load->view('backend/content/master/pdf/laporan', $data);
					$paper_size  = 'A4'; 
					$orientation = 'potrait'; 
					$html = $this->output->get_output();
					def("DOMPDF_ENABLE_REMOTE", false);
					$this->dompdf->load_html($html);
					$this->dompdf->render();
					$this->dompdf->stream("laporanpengaduansemua.pdf", array('Attachment'=>0));
				}
			} else {
				redirect("master/laporan");
			}
		} else {
			redirect("wp_login");
		}  
	}
}
