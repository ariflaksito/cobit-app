<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class cobit_model
# file models/cobit_model.php
# created Oct 16, 2012 7:56:12 PM
# 
# (c)2012, arif.laksito@gmail.com

class Cobit_model extends CI_Model {

    /**
     * variable untuk menyimpan hasil validasi dari
     * fungsi setField($rules,$data) dan getField()
     * @param array
     */
    var $field;

    /**
     * variable untuk menyimpan output messaage dari validasi
     * @param char
     */
    var $msg;

    /**
     * variabel menampilkan pesan ke user
     * @var char
     */
    var $umsg;

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function set_field($rules) {
        $this->field = array(); 
        
        $this->form_validation->set_rules($rules);       
        $this->form_validation->set_error_delimiters($prefix = '', $suffix = '<br />');

        if ($this->form_validation->run() == FALSE) {
            $this->msg = validation_errors();
            return false;
        }else
            return true;
    }

    public function get_field() {
        return $this->field;
    }

    public function get_msg() {
        return $this->umsg;
    }

}