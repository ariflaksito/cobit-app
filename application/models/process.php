<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class process
# file
# created Oct 17, 2012 10:12:45 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Process extends Cobit_model {

    public function get_process($id) {
        $this->db->where('domain_id', $id);
        $que = $this->db->get('process');

        return $que->result_array();
    }

    public function get_process_audit($id) {
        $this->db->where('process_audit.project_id', $id);
        $this->db->join('process', 'process_audit.process_id = process.process_id');
        $this->db->order_by('process_audit.domain_id, process.process_id');
        $que = $this->db->get('process_audit');

        return $que->result_array();
    }

    public function new_process_audit($data = array()) {

        $rules = array(
            array('field' => 'project_id', 'label' => 'ID Project', 'rules' => 'required|numeric|trim'),
            array('field' => 'process_id', 'label' => 'ID Process', 'rules' => 'required|numeric|trim'),
            array('field' => 'domain_id', 'label' => 'ID Domain', 'rules' => 'required|numeric|trim')
        );

        if (!$this->set_field($rules)) {
            $this->umsg = $this->msg;
            return false;
        }

        if ($this->db->insert('process_audit', $data)) {
            $this->umsg = 'Prosess berhasil ditambahkan';
            return true;
        } else {
            $this->umsg = 'Prosess gagal ditambahkan';
            return false;
        }
    }

    public function delete_process($id) {
        $this->db->where('project_id', $id);
        $this->db->delete('process_audit');
    }

    public function get_maturity() {
        $que = $this->db->get('maturity_model');
        return $que->result_array();
    }

    public function get_statement($pid, $mid, $prj) {    

        $str = "SELECT ps.statement_id,statement_name,report_value,report_date FROM process_statement ps
			LEFT JOIN process_audit pa ON pa.process_id = ps.process_id
			LEFT JOIN report r ON r.audit_id = pa.audit_id AND r.statement_id = ps.statement_id
			WHERE pa.project_id = $prj AND ps.process_id = $pid AND ps.maturity_model_id = $mid";
			
		$que = $this->db->query($str);	        
        return $que->result_array();
    }
	
	public function edit_statement($sid, $txt){
		$str = "Update process_statement Set statement_name='$txt' 
			Where statement_id=$sid";
		$this->db->query($str);	  	
	}
	
	public function view_statement($sid){
		$str = "Select statement_name From process_statement 
			Where statement_id=$sid";
			
		$que = $this->db->query($str);	        
        return $que->row_array();	
	}

    public function set_report($sid, $aid, $val) {

        $data = array(
            'statement_id' => $sid,
            'audit_id' => $aid,
            'report_value' => ($val>1)?$val*0.01:$val,
            'report_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('statement_id', $sid);
        $this->db->where('audit_id', $aid);
        $que = $this->db->get('report');

        if ($que->num_rows() > 0) {
            $this->db->where('statement_id', $sid);
            $this->db->where('audit_id', $aid);

            if ($this->db->update('report', $data))
                return true;
            else
                return false;
        }else {
            if ($this->db->insert('report', $data))
                return true;
            else
                return false;
        }
    }

    private function get_maturity_value($aid, $mid) {

        $this->db->select('report_value');
        $this->db->where('maturity_model_id', $mid);
        $this->db->where('report.audit_id', $aid);
        $this->db->join('process_audit', 'process_audit.audit_id=report.audit_id', 'left');
        $this->db->join('process_statement', 'process_statement.statement_id=report.statement_id', 'left');
        $que = $this->db->get('report');

        $data = $que->result_array();
        $count = 0;

        if ($que->num_rows() > 0) {
            foreach ($data as $d)
                $count += $d['report_value'];

            return $count / count($data);
        } else {
            return 0;
        }
    }
    
    private function get_statement_count($aid, $mid){
        $this->db->select('report_value');
        $this->db->where('maturity_model_id', $mid);
        $this->db->where('report.audit_id', $aid);
        $this->db->join('process_audit', 'process_audit.audit_id=report.audit_id', 'left');
        $this->db->join('process_statement', 'process_statement.statement_id=report.statement_id', 'left');
        $que = $this->db->get('report');
        
        return $que->num_rows();
    }

    public function get_report_value($id) {
        $proc = $this->get_process_audit($id);

        $i = 0;
        foreach ($proc as $p) {
            $aid[$i] = $p['audit_id'];
            $count_a = 0;
            for ($j = 0; $j < 6; $j++) {
                $proc[$i]['a'][$j] = round($this->get_maturity_value($aid[$i], $j+1), 2);
                $proc[$i]['ra'][$j] = $this->get_maturity_value($aid[$i], $j+1);
                $proc[$i]['cn'][$j] = $this->get_statement_count($aid[$i], $j+1);
                $count_a += $proc[$i]['a'][$j];
            }
            $proc[$i]['ca'] = $count_a;
            
            $count_b = 0;
            for ($z = 0; $z < 6; $z++) {
                if($proc[$i]['a'][$z]>0){
                    $proc[$i]['b'][$z] = round($proc[$i]['a'][$z]/$count_a, 3);
                    $count_b += $proc[$i]['b'][$z];
                }else
                    $proc[$i]['b'][$z] = 0;
            }
            $proc[$i]['cb'] = $count_b;
            
            $count = 0;
            for ($x = 0; $x < 6; $x++) {
                $proc[$i]['ab'][$x] = round($x*$proc[$i]['b'][$x],2);
                $count += $proc[$i]['ab'][$x];
            }
            $proc[$i]['level'] = $count;
            
            $i++;
        }

        return $proc;
    }

	public function edit_process($id, $recc){
		$str = "Update process_audit Set recc='$recc' Where audit_id=$id";
		$this->db->query($str);	  	
	}

}
