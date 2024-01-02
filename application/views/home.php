<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# file /views/home.php
# created Oct 10, 2012 8:42:31 PM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $this->config->item('app_name')?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">		
        <link href="<?php echo base_url('bootstrap/css/bootstrap.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.css')?>" rel="stylesheet"> 
        <link href="<?php echo base_url('bootstrap/css/font-awesome.css')?>" rel="stylesheet"> 

        <script src="<?php echo base_url('bootstrap/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('bootstrap/js/bootstrap-modal.js')?>"></script>
    </head>    

    <body>                

        <div class="container">
            <div class="well">
                <header class="jumbotron subhead" id="overview">
                    <div class="row">
                        <div class="span12">
                            <h1><?php echo $this->config->item('project')?>
                                <small><?php echo $this->config->item('app_name')?></small>
                            </h1>
                        </div>                    
                    </div>                
                </header>
                <ul class="nav nav-tabs">
                    <li <?php echo $link_home ?>>
                        <a href="<?php echo site_url() ?>">Home</a>
                    </li>
                    <li <?php echo $link_start?>><a href="<?php echo site_url('app/start')?>">Mulai Penilaian</a></li>
                    <li <?php echo $link_report?>><a href="<?php echo site_url('app/report')?>">Laporan Penilaian</a></li>
                    <li <?php echo $link_about?>><a href="<?php echo site_url('app/about')?>">About App</a></li>
                </ul>
                <div class="row">
                    <div class="span11">
                        <?php $this->load->view($page)?>
                    </div>
                </div>
            </div> 
            <div style="text-align: center"><small>&copy; 2012, Arif Laksito - STMIK AMIKOM Yogyakarta</small></div>
        </div>    
    </body>
</html>    