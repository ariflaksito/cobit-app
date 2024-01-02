<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class domain
# file models/domain.php
# created Oct 17, 2012 9:41:39 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Domain extends Cobit_model{
    
    public function get_domain(){
        $que = $this->db->get('domain');
        return $que->result_array();
    }
    
}
