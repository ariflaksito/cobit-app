<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# file /views/load_st.php
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
        <link href="<?php echo base_url('bootstrap/css/bootstrap.css')?>" rel="stylesheet"> 
        <link href="<?php echo base_url('bootstrap/css/font-awesome.css')?>" rel="stylesheet"> 

        <script src="<?php echo base_url('bootstrap/js/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo base_url('bootstrap/js/bootstrap-modal.js')?>"></script>
    </head>    

    <body style="background-color:#fff; padding:10px">    	
    		    	
    	<form action="" method="post">
    		<legend>Edit Statement</legend>
    		<textarea class="input-xlarge" name="st" rows="5"><?php echo $st['statement_name']?></textarea>
    		<br />
    		<input type="submit" name="submit" value="Update">
    	</form>
    				
	</body>
	
</html>