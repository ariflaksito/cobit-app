<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class load
# file controllers/load.php
# created Oct 20, 2012 8:53:22 PM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class load extends CI_Controller{
    
    public function st($sid, $aid, $val){
        $this->load->model('process');
        $this->process->set_report($sid, $aid, $val);
    }
	
	public function et($sid){
		$this->load->model('process');		
		$data['st'] = $this->process->view_statement($sid);
		
		if($this->input->post('submit')){
			$txt = $this->input->post('st');
			$this->process->edit_statement($sid, $txt);
			$data['st'] = $this->process->view_statement($sid);			
		}
				
		$this->load->view('load_st', $data);
		
	}
    
}
