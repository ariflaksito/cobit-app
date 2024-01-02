<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class main_home
# file /views/main_home.php
# created Oct 11, 2012 11:05:40 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h3>COBIT</h3>
<p>
    Control Objectives For Information And Related Technology (COBIT) 
    adalah sekumpulan dokumentasi best practise untuk tata kelola TI 
    yang dapat membantu auditor, manajemen dan pengguna untuk menjembatani 
    gap antara resiko bisnis, kebutuhan kontrol dan permasalahan teknis
</p>
<blockquote class="pull-right"><small>(IT Governance Institute, 2000)</small></blockquote>                        
<br />                        
<h3>Model Kematangan</h3>
<p>
    COBIT mempunyai model kematangan (maturity models) untuk mengontrol 
    proses-proses TI dengan menggunakan metode penilaian (scoring) sehingga 
    suatu organisasi dapat menilai proses-proses TI yang dimilikinya dari 
    skala 0 sampai 5. Berikut penjabaran dari level maturity models                            
</p>
<blockquote class="pull-right"><small>(IT Governance Institute, 2007)</small></blockquote>  
<br />
<h3>CobitApp</h3>
<p>
    CobitApp adalah aplikasi berbasis web yang digunakan untuk mengukur tingkat 
    kematangan(maturity model) proses dalam domain Cobit. Hasil dari aplikasi ini
    dapat disajikan dalam diagram bar chart atau radar chart untuk tiap proses tersebut.    
</p>
<p>
	Perhitungan maturity level tiap proses berdasarkan framework COBIT 4.1 yang dapat dicetak 
	untuk lebih detailnya.
</p>
<blockquote class="pull-right"><small>(Arif Laksito, 2012)</small></blockquote>  

<br /><br />

<a href="<?php echo $this->config->site_url()?>app/start">
<button class="btn btn-primary" type="button">Mulai Penilaian</button>
</a>