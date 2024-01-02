<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class app
# file /controllers/app.php
# created Oct 10, 2012 8:35:48 PM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App extends CI_Controller {

    public function index() {
        $data = array();
        $data['page'] = 'main_home';
        $data['link_home'] = "class='active'";
        $data['link_start'] = "";
        $data['link_report'] = "";
        $data['link_about'] = "";

        $this->load->view('home', $data);
    }

    public function start() {
        $data = array();
        $data['page'] = 'main_start';
        $data['link_home'] = "";
        $data['link_start'] = "class='active'";
        $data['link_report'] = "";
        $data['link_about'] = "";

        $post = $this->input->post();
        if ($post['go']) {
            $this->load->model('project');
            if ($this->project->new_project($post)) {
                header('location:' . $this->config->item('base_url') .
                        'app/process/' . $this->db->insert_id());
            } else {
                $data['sts'] = 0;
            }
            $data['msg'] = $this->project->get_msg();
        }

        $data['post'] = $post;
        $this->load->view('home', $data);
    }

    public function istart($id) {
        $data = array();
        $data['page'] = 'main_start';
        $data['link_home'] = "";
        $data['link_start'] = "class='active'";
        $data['link_report'] = "";
        $data['link_about'] = "";

        $this->load->model('project');
        $data['post'] = $this->project->get_project($id);

        $post = $this->input->post();
        if ($post['go']) {
            $this->load->model('project');
            if ($this->project->edit_project($id, $post)) {
                header('location:' . $this->config->item('base_url') .
                        '/app/process/' . $id);
            } else {
                $data['sts'] = 0;
            }
            $data['msg'] = $this->project->get_msg();
            $data['post'] = $post;
        }

        $this->load->view('home', $data);
    }

    public function process($id) {
        $data = array();
        $data['page'] = 'main_process';
        $data['link_home'] = "";
        $data['link_start'] = "class='active'";
        $data['link_report'] = "";
        $data['link_about'] = "";
        $data['id'] = $id;

        $this->load->model('project');
        $data['proj'] = $this->project->get_project($id);

        $this->load->model('domain');
        $data['dmn'] = $this->domain->get_domain();

        $this->load->model('process');

        for ($i = 1; $i < 5; $i++)
            $data['prs'][$i] = $this->process->get_process($i);



        $data['post'] = $this->process->get_process_audit($id);

        $post = $this->input->post();
        if ($post['go']) {
            if (!isset($post['p'])) {
                $data['sts'] = 0;
                $data['msg'] = "Anda harus pilih satu proses atau lebih";
            } else {
                $sts = 0;
                $this->process->delete_process($id);
                foreach ($post['p'] as $p) {
                    $ins['project_id'] = $id;
                    $val = explode('*', $p);
                    $ins['process_id'] = $val[0];
                    $ins['domain_id'] = $val[1];
                    $_POST = $ins;

                    if (!$this->process->new_process_audit($_POST)) {
                        $data['sts'] = 0;
                        $data['msg'] = $this->process->get_msg();
                        break;
                    } else {
                        $sts = 1;
                    }
                }

                if ($sts == 1) {
                    header('location:' . $this->config->item('base_url') .
                            '/app/confirm/' . $id);
                }
            }
        }

        $this->load->view('home', $data);
    }

    public function confirm($id) {
        $data = array();
        $data['page'] = 'main_confirm';
        $data['link_home'] = "";
        $data['link_start'] = "class='active'";
        $data['link_report'] = "";
        $data['link_about'] = "";
        $data['id'] = $id;

        $this->load->model('project');
        $data['proj'] = $this->project->get_project($id);

        $this->load->model('process');
        $data['proc'] = $this->process->get_process_audit($id);

        $this->load->view('home', $data);
    }

    public function nilai($id, $pid) {
    	
		//$this->output->enable_profiler(true);
		
        $data = array();
        $data['page'] = 'main_nilai';
        $data['link_home'] = "";
        $data['link_start'] = "class='active'";
        $data['link_report'] = "";
        $data['link_about'] = "";
        $data['id'] = $id;
        $data['pid'] = $pid;

        $this->load->model('project');
        $data['proj'] = $this->project->get_project($id);

        $this->load->model('process');
        $data['proc'] = $this->process->get_process_audit($id);

        $num_procc = count($data['proc']);

        if ($pid >= $num_procc) {
            header('location:' . $this->config->item('base_url') . 'app/report/' . $id);
            exit();
        }

        $data['pc'] = $data['proc'][$pid];
        $data['matr'] = $this->process->get_maturity();

        for ($i = 1; $i < 7; $i++)
            $data['st'][$i] = $this->process->get_statement($data['proc'][$pid]['process_id'], $i, $id);

        $this->load->view('home', $data);
    }

    public function report($id = '') {
        $data = array();
        $page = ($id == '') ? 'main_report' : 'proj_report';

        $data['page'] = $page;
        $data['link_home'] = "";
        $data['link_start'] = "";
        $data['link_report'] = "class='active'";
        $data['link_about'] = "";
				
        $post = $this->input->post();
        if(!empty($post['go'])){
            $this->load->model('project');
            $data['proj'] = $this->project->get_project_by_email($post['email']);
            $data['msg'] = $this->project->get_msg();
            $data['post'] = $post;
			
        }else if($post['audit_id']){
			$audit_id = $post['audit_id'];
			$recc = $post['recc'];
			
			$this->load->model('process');
			$this->process->edit_process($audit_id,$recc);
			
			redirect('app/report/'.$id);
			
		}

        if ($id != '') {
            $this->load->model(array('project', 'process'));
            $data['proj'] = $this->project->get_project($id);
            $data['maturity'] = $this->process->get_report_value($id);
        }

        $this->load->view('home', $data);
    }

    public function about() {
        $data = array();
        $data['page'] = 'main_about';
        $data['link_home'] = "";
        $data['link_start'] = "";
        $data['link_report'] = "";
        $data['link_about'] = "class='active'";

        $this->load->view('home', $data);
    }
	
	public function print_process($id){
		$this->load->model('project');
        $data['proj'] = $this->project->get_project($id);

        $this->load->model('process');
        $proc = $this->process->get_process_audit($id);
		$data['matr'] = $this->process->get_maturity();
		
		$j = 0;
		foreach($proc as $p){
			$data['proc'][$j] = $p;
			for ($i = 1; $i < 7; $i++)
            	$data['proc'][$j]['st'][$i] = $this->process->get_statement($proc[$j]['process_id'], $i, $id);
			$j++;
		}
		
		$this->load->view('print_process', $data);
		
	}
	
	public function print_maturity($id){
		$this->load->model(array('project', 'process'));
        $data['proj'] = $this->project->get_project($id);
        $data['maturity'] = $this->process->get_report_value($id);
				
		$this->load->view('print_maturity', $data);
	}
	
	public function s15(){
		$this->load->model('project');
		
		$data = array();
		$data['proj'] = $this->project->list_project();
		$data['link_home'] = "";
        $data['link_start'] = "";
        $data['link_report'] = "";
        $data['link_about'] = "";
		$data['page'] = 'list_project';		
		
		$this->load->view('home', $data);
	}
	
}
