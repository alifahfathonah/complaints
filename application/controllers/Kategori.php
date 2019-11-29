<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {

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
			redirect("master/pengduan");
		} else {
			redirect("login");
		}
	 }
	
	//FUNCTION Pekerjaan
	public function pekerjaan($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Pekerjaan';
				$data['content'] 			= 'backend/content/kategori/pekerjaan';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('pekerjaan_jenis'=>'Jenis');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pekerjaan_jenis';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_pekerjaan[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_pekerjaan('', $like_pekerjaan);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					$data['validate']			= array('pekerjaan_jenis'=>'Jenis'
												);
					$data['onload']				= 'pekerjaan_id';
					$data['pekerjaan_jenis']			= ($this->input->post('pekerjaan_jenis'))?$this->input->post('pekerjaan_jenis'):'';
					
					$simpan						= $this->input->post('simpan');
					if ($simpan){								
						$insert['pekerjaan_jenis']		= validasi_sql($data['pekerjaan_jenis']);
						$this->ADM->insert_pekerjaan($insert);
						$this->session->set_flashdata('success','Pekerjaan baru telah berhasil ditambahkan!,');
						redirect("kategori/pekerjaan");
					}
				} elseif ($data['action'] == 'edit'){				
					$where['username']		       = $filter2; 
					$data['validate']			= array('pekerjaan_jenis'=>'Jenis'
														);
					$data['onload']					= 'pekerjaan_id';
					$where_pekerjaan['pekerjaan_id']		= $filter2; 
					$pekerjaan							= $this->ADM->get_pekerjaan('*', $where_pekerjaan);
					$data['pekerjaan_id']				= ($this->input->post('pekerjaan_id'))?$this->input->post('pekerjaan_id'):$pekerjaan->pekerjaan_id;
					$data['pekerjaan_jenis']				= ($this->input->post('pekerjaan_jenis'))?$this->input->post('pekerjaan_jenis'):$pekerjaan->pekerjaan_jenis;				
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['pekerjaan_id']	= validasi_sql($data['pekerjaan_id']);
						$edit['pekerjaan_jenis']			= validasi_sql($data['pekerjaan_jenis']);
						$this->ADM->update_pekerjaan($where_edit, $edit);
						$this->session->set_flashdata('success','Pekerjaan telah berhasil diedit!,');
						redirect("kategori/pekerjaan");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					         = 'pekerjaan_id';
					$where_pekerjaan['pekerjaan_id']		        = $filter2; 
					$data['pekerjaan']							= $this->ADM->get_pekerjaan('*', $where_pekerjaan);
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['pekerjaan_id'] = validasi_sql($filter2);
					$this->ADM->delete_pekerjaan($where_delete);
					$this->session->set_flashdata('warning','Pekerjaan telah berhasil dihapus!,');
					redirect("kategori/pekerjaan");
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
	// ================================================== END pekerjaan ================================================== //

	//FUNCTION Pengaduan
	public function pengaduan($filter1='', $filter2='', $filter3='')
	{
		if ($this->session->userdata('sign_in') == TRUE){
			$where_admin['username'] 	= $this->session->userdata('username');
			$data['admin'] 				= $this->ADM->get_admin('',$where_admin);
			if ($data['admin']->user_role === 'admin') {
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Jenis Pengaduan';
				$data['content'] 			= 'backend/content/kategori/pengaduan';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('pengaduan_jenis'=>'Jenis');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pengaduan_jenis';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_pengaduan[$data['cari']]	= $data['q'];
					$data['jml_data']			= $this->ADM->count_all_pengaduan('', $like_pengaduan);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				} elseif ($data['action'] == 'tambah'){
					$data['validate']			= array('pengaduan_jenis'=>'Jenis'
												);
					$data['onload']				= 'pengaduan_id';
					$data['pengaduan_jenis']			= ($this->input->post('pengaduan_jenis'))?$this->input->post('pengaduan_jenis'):'';
					
					$simpan						= $this->input->post('simpan');
					if ($simpan){								
						$insert['pengaduan_jenis']		= validasi_sql($data['pengaduan_jenis']);
						$this->ADM->insert_pengaduan($insert);
						$this->session->set_flashdata('success','Pengaduan baru telah berhasil ditambahkan!,');
						redirect("kategori/pengaduan");
					}
				} elseif ($data['action'] == 'edit'){				
					$where['username']		       = $filter2; 
					$data['validate']			= array('pengaduan_jenis'=>'Jenis'
														);
					$data['onload']					= 'pengaduan_id';
					$where_pengaduan['pengaduan_id']		= $filter2; 
					$pengaduan							= $this->ADM->get_pengaduan('*', $where_pengaduan);
					$data['pengaduan_id']				= ($this->input->post('pengaduan_id'))?$this->input->post('pengaduan_id'):$pengaduan->pengaduan_id;
					$data['pengaduan_jenis']				= ($this->input->post('pengaduan_jenis'))?$this->input->post('pengaduan_jenis'):$pengaduan->pengaduan_jenis;				
					$simpan							= $this->input->post('simpan');
					if ($simpan){
						$where_edit['pengaduan_id']	= validasi_sql($data['pengaduan_id']);
						$edit['pengaduan_jenis']			= validasi_sql($data['pengaduan_jenis']);
						$this->ADM->update_pengaduan($where_edit, $edit);
						$this->session->set_flashdata('success','Pengaduan telah berhasil diedit!,');
						redirect("kategori/pengaduan");
					}
				} elseif ($data['action'] == 'detail'){		
					$data['onload']					         = 'pengaduan_id';
					$where_pengaduan['pengaduan_id']		        = $filter2; 
					$data['pengaduan']							= $this->ADM->get_pengaduan('*', $where_pengaduan);
				} elseif ($data['action'] == 'hapus'){				
					$where_delete['pengaduan_id'] = validasi_sql($filter2);
					$this->ADM->delete_pengaduan($where_delete);
					$this->session->set_flashdata('warning','Pengaduan telah berhasil dihapus!,');
					redirect("kategori/pengaduan");
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
}
