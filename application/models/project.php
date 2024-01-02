<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class project
# file models/project.php
# created Oct 16, 2012 8:42:08 PM
# 
# (c)2012, arif.laksito@gmail.com

class Project extends Cobit_model {

    public function new_project($data = array()) {
        $rules = array(
            array('field' => 'full_name', 'label' => 'Nama Lengkap', 'rules' => 'required|alpha_space|trim'),
            array('field' => 'email', 'label' => 'Alamat Email', 'rules' => 'required|valid_email|trim'),
            array('field' => 'project_name', 'label' => 'Nama Project', 'rules' => 'required|trim')
        );

        if (!$this->set_field($rules)) {
            $this->umsg = $this->msg;
            return false;
        }

        array_pop($data);
        $data['project_date'] = date('Y-m-d H:i:s');
        if ($this->db->insert('project', $data)) {            
            return true;
        } else {
            $this->umsg = 'Project gagal ditambahkan';
            return false;
        }
    }
    
    public function edit_project($id, $data = array()) {
        $rules = array(
            array('field' => 'full_name', 'label' => 'Nama Lengkap', 'rules' => 'required|alpha_space|trim'),
            array('field' => 'email', 'label' => 'Alamat Email', 'rules' => 'required|valid_email|trim'),
            array('field' => 'project_name', 'label' => 'Nama Project', 'rules' => 'required|trim')
        );

        if (!$this->set_field($rules)) {
            $this->umsg = $this->msg;
            return false;
        }

        array_pop($data);        
        
        $this->db->where('project_id', $id);
        if ($this->db->update('project', $data)) {            
            return true;
        } else {
            $this->umsg = 'Project gagal diubah';
            return false;
        }
    }
    
	public function list_project(){
		$que = $this->db->get('project');        
		$this->load->model('process');
		
		$out = $que->result_array();		
		for($i=0; $i<count($out); $i++){
			$out[$i]['proc'] = $this->process->get_process_audit($out[$i]['project_id']);
		}				
			
		return $out;
			
        //return $que->result_array();
	}
	
    public function get_project($id){
        $this->db->where('project_id',$id);
        $que = $this->db->get('project');
        
        return $que->row_array();
    }
	
	public function get_project_by_email($mail){
	
		$rules = array(            
            array('field' => 'email', 'label' => 'Alamat Email', 'rules' => 'required|valid_email|trim')            
        );
	
		if (!$this->set_field($rules)) {
            $this->umsg = $this->msg;
            return false;
        }
	
		$this->db->where('email',$mail);
        $que = $this->db->get('project');
        
		if($que->num_rows()>0){
			$out = $que->result_array();
			$this->load->model('process');
			for($i=0; $i<count($out); $i++){
				$out[$i]['proc'] = $this->process->get_process_audit($out[$i]['project_id']);
			}				
			
			return $out;
			
		}else $this->umsg = "Project dengan email $mail tidak ditemukan";	
	}

}