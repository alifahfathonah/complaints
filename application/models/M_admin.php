<?php
class M_admin extends CI_Model  {

    public function __contsruct(){
        parent::Model();
    }

	//CONFIGURATION TABEL laporan
	public function insert_laporan($data){
        $this->db->insert("laporan",$data);
    }
    
    public function update_laporan($where,$data){
        $this->db->update("laporan",$data,$where);
    }

    public function delete_laporan($where){
        $this->db->delete("laporan", $where);
    }

	public function get_laporan($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("laporan AS l");
		$this->db->join('pengaduan AS p', 'l.pengaduan_id = p.pengaduan_id');
		$this->db->join('masyarakat AS m', 'l.masyarakat_username = m.masyarakat_username');
		$this->db->join('pekerjaan AS pk', 'm.pekerjaan_id = pk.pekerjaan_id');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_laporan($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("laporan AS l");
		$this->db->join('pengaduan AS p', 'l.pengaduan_id = p.pengaduan_id');
		$this->db->join('masyarakat AS m', 'l.masyarakat_username = m.masyarakat_username');
		$this->db->join('pekerjaan AS pk', 'm.pekerjaan_id = pk.pekerjaan_id');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_laporan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("laporan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	
	public function grid_all_laporan2($select, $orderBy, $sortBy, $limit, $start, $month="", $year="", $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("laporan as l");
		$this->db->join('pengaduan AS p', 'l.pengaduan_id = p.pengaduan_id');
		$this->db->join('masyarakat AS m', 'l.masyarakat_username = m.masyarakat_username');
		$this->db->join('pekerjaan AS pk', 'm.pekerjaan_id = pk.pekerjaan_id');
		if ($month){
			$this->db->where("DATE_FORMAT(laporan_created,'%m')", $month);
			$this->db->where("DATE_FORMAT(laporan_created,'%Y')", $year);
		}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
		if ($where){$this->db->where($where);}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
	}
	public function count_all_laporan2($month="", $year="", $where="", $like=""){
        $this->db->select("*");
        $this->db->from("laporan");
		if ($month){
			$this->db->where("DATE_FORMAT(laporan_created,'%m')", $month);
			$this->db->where("DATE_FORMAT(laporan_created,'%Y')", $year);
		}
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	//CONFIGURATION TABEL masyarakat
	public function insert_masyarakat($data){
        $this->db->insert("masyarakat",$data);
    }
    
    public function update_masyarakat($where,$data){
        $this->db->update("masyarakat",$data,$where);
    }

    public function delete_masyarakat($where){
        $this->db->delete("masyarakat", $where);
    }

	public function get_masyarakat($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("masyarakat AS m");
		$this->db->join('pekerjaan AS p', 'm.pekerjaan_id = p.pekerjaan_id');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_masyarakat($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("masyarakat AS M");
		$this->db->join('pekerjaan AS p', 'm.pekerjaan_id = p.pekerjaan_id');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_masyarakat($where="", $like=""){
        $this->db->select("*");
        $this->db->from("masyarakat");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}
	
	//CONFIGURATION TABEL pengaduan
	public function insert_pengaduan($data){
        $this->db->insert("pengaduan",$data);
    }
    
    public function update_pengaduan($where,$data){
        $this->db->update("pengaduan",$data,$where);
    }

    public function delete_pengaduan($where){
        $this->db->delete("pengaduan", $where);
    }

	public function get_pengaduan($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("pengaduan");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_pengaduan($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pengaduan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_pengaduan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pengaduan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	//CONFIGURATION TABEL pekerjaan
	public function insert_pekerjaan($data){
        $this->db->insert("pekerjaan",$data);
    }
    
    public function update_pekerjaan($where,$data){
        $this->db->update("pekerjaan",$data,$where);
    }

    public function delete_pekerjaan($where){
        $this->db->delete("pekerjaan", $where);
    }

	public function get_pekerjaan($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("pekerjaan");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_pekerjaan($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pekerjaan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_pekerjaan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pekerjaan");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
	}

	//CONFIGURATION TABEL USER
	public function select_admin(){
		$data = $this->db->get('user')->result();
		return $data;
	}

	public function insert_admin($data){
        $this->db->insert("user",$data);
    }
    
    public function update_admin($where,$data){
        $this->db->update("user",$data,$where);
    }

    public function delete_admin($where){
        $this->db->delete("user", $where);
    }

	public function get_admin($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("user");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_admin($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("user");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

	public function count_all_admin($where="", $like=""){
        $this->db->select("*");
        $this->db->from("user");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

	//CONFIGURATION TABEL IDENTITAS
	public function select_identitas(){
		$data = $this->db->get('identitas')->result();
		return $data;
	}

	public function insert_identitas($data){
        $this->db->insert("identitas",$data);
    }
    
    public function update_identitas($where,$data){
        $this->db->update("identitas",$data,$where);
    }

    public function delete_identitas($where){
        $this->db->delete("identitas", $where);
    }

	public function get_identitas($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_identitas($select, $orderBy, $sortBy, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($orderBy, $sortBy);
        $this->db->limit($limit, $start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_identitas($where="", $like=""){
        $this->db->select("*");
        $this->db->from("identitas");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	
	public function identitaswebsite(){
        $data = "";
		$where['identitas_id'] = 1;
		$this->db->select("*");
        $this->db->from("identitas");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
    
    // CONFIGURATION COMBO BOX WITH DATABASE WITH VALIDASI
	public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}

    // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box2($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	   // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box3($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name'  style='display:none;' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_kelas($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->kelas_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function listarray($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo $row->$name_value.", ";
			}
		}
	}
}