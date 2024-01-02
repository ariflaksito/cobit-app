<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class print_process
# file /views/print_process.php
# created Nov 10, 2012 06:55:12 AM
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

    <body style="background-color:#fff" onload="window.print()">      
	<div style="padding: 20px">
		
		
<h1>Laporan Hasil Perhitungan Maturity Model</h1>		
<?php for($j=0; $j<count($maturity); $j++):?>
	
	<h3>Detail Laporan dari Proses<br /><?php echo $maturity[$j]['process_short_name'].' - '.$maturity[$j]['process_name']?></h3>
	
	<table style="width:95%" class="table table-bordered table-hover table-condensed">
        <thead>
            <tr><td colspan="4">Computation of the Maturity Level Compliences Value</td></tr>
        </thead>
        <thead>
            <tr>
                <td>Maturity Level</td>
                <td>Sum of statements compliance values (A)</td>
                <td>Number of maturity level statements (B)</td>
                <td>Maturity level complience value (A/B)</td>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<6; $i++):?>    
            <tr>
                <td style="text-align:right"><?php echo $i?></td>
                <td style="text-align:right"><?php echo $maturity[$j]['cn'][$i]*$maturity[$j]['ra'][$i]?></td>
                <td style="text-align:right"><?php echo $maturity[$j]['cn'][$i]?></td>                
                <td style="text-align:right"><?php echo number_format($maturity[$j]['a'][$i],2)?></td>
            </tr>
        <?php endfor?>    
        </tbody>
    </table>
    
    <table style="width:75%" class="table table-bordered table-hover table-condensed">
        <thead>
            <tr><td colspan="3">Computation of the normalized Complience Vektor</td></tr>
        </thead>
        <thead>
            <tr>
                <td style="width:30%">Level</td>
                <td>Not normalized compliences values (A)</td>
                <td>Normalized compliences values [A/Sum(A)]</td>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<6; $i++):?>    
            <tr>
                <td style="text-align:right"><?php echo $i?></td>
                <td style="text-align:right"><?php echo number_format($maturity[$j]['a'][$i],2)?></td>
                <td style="text-align:right"><?php echo number_format($maturity[$j]['b'][$i],3)?></td>
            </tr>
        <?php endfor?>                
            <tr>
                <td>Total</td>
                <td style="text-align:right"><?php echo $maturity[$j]['ca']?></td>
                <td style="text-align:right"><?php echo $maturity[$j]['cb']?></td>
            </tr>           
        </tbody>
        
    </table>
    
    <table style="width:75%" class="table table-bordered table-hover table-condensed">
        <thead>
            <tr><td colspan="3">Computation of the Summary Maturity Level</td></tr>
        </thead>
        <thead>
            <tr>
                <td style="width:30%">Level</td>
                <td>Normalized compliences values (B)</td>
                <td>Contribution (A*B)</td>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0; $i<6; $i++):?>    
            <tr>
                <td style="text-align:right"><?php echo $i?></td>
                <td style="text-align:right"><?php echo number_format($maturity[$j]['b'][$i],3)?></td>
                <td style="text-align:right"><?php echo number_format($maturity[$j]['ab'][$i],2)?></td>
            </tr>
        <?php endfor?>  
            <tr>
                <th colspan="2" style="text-align:right">Total Maturity Model <?php echo $maturity[$j]['process_short_name']?></th>
                <th style="text-align:right"><?php echo $maturity[$j]['level']?></th>
            </tr> 
        </tbody>    
    </table>    
	
<?php endfor?>
	
	</div>
	</body>
</html>	