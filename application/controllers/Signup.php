<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'LOG', TRUE);
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
        if ($this->session->userdata('sign_in') == TRUE){       
            redirect('admin/','refresh');
        } else {     
			$data['web']					= $this->ADM->identitaswebsite();
			$this->load->vars($data);
			$this->load->view('backend/signup');
        }
	}
	
	public function simpan()
	{
		$data['validate']			= array('masyarakat_username'=>'Username',
											'masyarakat_password'=>'Password',
											'masyarakat_nama'=>'Nama',
											'masyarakat_alamat'=>'Alamat',
											'masyarakat_notelp'=>'No Telp',
											'masyarakat_email'=>'Email',
											'masyarakat_no'=>'No KTP/SIM/Paspor',
											'pekerjaan_id'=>'ID Pekerjaan'
												);
					$data['onload']				= 'masyarakat_username';
					$data['masyarakat_username']			= ($this->input->post('masyarakat_username'))?$this->input->post('masyarakat_username'):'';
					$data['masyarakat_nama']			= ($this->input->post('masyarakat_nama'))?$this->input->post('masyarakat_nama'):'';
					$data['masyarakat_alamat']			= ($this->input->post('masyarakat_alamat'))?$this->input->post('masyarakat_alamat'):'';
					$data['masyarakat_notelp']			= ($this->input->post('masyarakat_notelp'))?$this->input->post('masyarakat_notelp'):'';
					$data['masyarakat_email']			= ($this->input->post('masyarakat_email'))?$this->input->post('masyarakat_email'):'';
					$data['masyarakat_no']			= ($this->input->post('masyarakat_no'))?$this->input->post('masyarakat_no'):'';
					$data['masyarakat_password']			= ($this->input->post('masyarakat_password'))?$this->input->post('masyarakat_password'):'';	
					$data['pekerjaan_id']			= ($this->input->post('pekerjaan_id'))?$this->input->post('pekerjaan_id'):'';	
					
					$where['username']		= $data['masyarakat_username'];
					$jml_pengguna				= $this->ADM->count_all_admin($where);
					if ($jml_pengguna < 1 ){		
					$simpan						= $this->input->post('simpan');
					$insert['username']		= validasi_sql($data['masyarakat_username']);
					$insert['password']		= validasi_sql(do_hash(($data['masyarakat_password']), 'md5'));
					$insert['user_nama']		= validasi_sql($data['masyarakat_nama']);
					$insert['user_role']		= 'user';
					$this->ADM->insert_admin($insert);

					$insert2['masyarakat_username']		= validasi_sql($data['masyarakat_username']);
					$insert2['masyarakat_password']		= validasi_sql(do_hash(($data['masyarakat_password']), 'md5'));
					$insert2['masyarakat_nama']		= validasi_sql($data['masyarakat_nama']);
					$insert2['masyarakat_alamat']		= validasi_sql($data['masyarakat_alamat']);
					$insert2['masyarakat_notelp']		= validasi_sql($data['masyarakat_notelp']);
					$insert2['masyarakat_email']		= validasi_sql($data['masyarakat_email']);
					$insert2['masyarakat_no']		= validasi_sql($data['masyarakat_no']);
					$insert2['pekerjaan_id']		= validasi_sql($data['pekerjaan_id']);
					$this->ADM->insert_masyarakat($insert2);

					$this->session->set_flashdata('success','Berhasil melaukan Pendaftaran!,');
					redirect("login");
				} elseif ($jml_pengguna > 0 ){
					$this->session->set_flashdata('warning','Masyarakat telah terdaftar!,');
						redirect("signup");
				}
	}
}