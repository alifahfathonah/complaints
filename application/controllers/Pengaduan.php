<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'LOG', TRUE);
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
        if ($this->session->userdata('sign_in') == FALSE){
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Pengaduan';
				$data['action']				= (empty($filter1))?'view':$filter1;			
				if ($data['action'] == 'view'){
					$data['berdasarkan']		= array('pengaduan_id'=>'Jenis Pengaduan');
					$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pengaduan_id';
					$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
					$data['halaman']			= (empty($filter2))?1:$filter2;
					$data['batas']				= 10;
					$data['page']				= ($data['halaman']-1) * $data['batas'];
					$like_laporan[$data['cari']]	= $data['q'];
					$where_laporan['laporan_status']	= 1;
					$data['jml_data']			= $this->ADM->count_all_laporan($where_laporan, $like_laporan);
					$data['jml_halaman'] 		= ceil($data['jml_data']/$data['batas']);
				}  elseif ($data['action'] == 'detail'){		
					$data['onload']					= 'laporan_id';
					$where_laporan['laporan_id']		        = $filter2; 
					$data['laporan']							= $this->ADM->get_laporan('*', $where_laporan);
				}
			$this->load->vars($data);
			$this->load->view('backend/pengaduan');
		} else {  
            redirect('admin/','refresh');
		}
    }

    public function detail($filter1='', $filter2='', $filter3='') {
    	        if ($this->session->userdata('sign_in') == FALSE){
				$data['web']				= $this->ADM->identitaswebsite();
				@date_default_timezone_set('Asia/Jakarta');
				$data['breadcrumb']         = 'Pengaduan';
					$data['onload']					= 'laporan_id';
					$where_laporan['laporan_id']		        = $filter1; 
					$data['laporan']							= $this->ADM->get_laporan('*', $where_laporan);
			$this->load->vars($data);
			$this->load->view('backend/pengaduandetail');
		} else {  
            redirect('admin/','refresh');
		}
    }

}