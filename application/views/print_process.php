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
	
	<h1>Laporan Penilaian tiap-tiap Proses</h1>
	<?php for($j=0; $j<count($proc); $j++):?>
		<h3>Penilaian <?php echo $proc[$j]['process_short_name'].' - '.$proc[$j]['process_name']?></h3>
		<?php for($i=1; $i<=count($proc[$j]['st']); $i++):?>
			
			<h5>Maturity Model Level <?php echo $matr[$i-1]['maturity_model_level'] . ' (' . $matr[$i-1]['maturity_model_name'] . ')' ?></h5>
			<table class="table table-bordered table-hover table-condensed"> 
				<?php $total = 0;?>
				<?php for($x=0; $x<count($proc[$j]['st'][$i]); $x++):?>
					<?php $value = $proc[$j]['st'][$i][$x]['report_value']?>
					<?php $total += $value?>
					<tr>
		                <td><?php echo $x+1 ?></td>
		                <td><?php echo $proc[$j]['st'][$i][$x]['statement_name']?></td>		                		               
		                <td width="10%" style="text-align:right"><?php echo $value?></td>
		            </tr>     
				<?php endfor?>	
					<tr>
						<td colspan="2" style="text-align:right">Nilai Total</td>
						<td style="text-align:right"><?php echo $total?></td>
					</tr>	
			</table>	
			
		<?php endfor?>		
	<?php endfor?>	
			
	</div>	
	</body>
</html>	