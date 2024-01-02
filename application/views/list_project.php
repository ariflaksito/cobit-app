<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
#
# version 1.0
# class main_home
# file /views/main_home.php
# created Jun 20, 2013 06:57:40 AM
#
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>
<h3>List Project</h3>
<p>
	Daftar Beberapa Project yang telah menggunakan Aplikasi ini
</p>
<table class="table table-bordered table-hover table-condensed">
	<thead>
		<tr class="warning">
			<th>No</th>
			<th>Nama Project</th>
			<th>Tgl Reg</th>
			<th>Jml Proses</th>
			<th>Report</th>
		</tr>
	<thead>
	<tbody>
		<?php $i = 1?>
		<?php foreach ($proj as $p): ?>	
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $p['project_name'] ?></td>
                    <td><?php echo mdate('%d %M %Y', mysql_to_unix($p['project_date'])) ?></td>
                    <td style="text-align:center"><?php echo count($p['proc']) ?></td>		
                    <td style="text-align:center">
                    	<?php if(count($p['proc'])>0):?>
                        <a href="<?php echo site_url('app/report/' . $p['project_id']) ?>"><i class="icon-list-alt"></i></a>
                        <?php else:?>
                        <a href="<?php echo site_url('app/process/'.$p['project_id'])?>">Pilih Proses</a>	
                        <?php endif?>	
                    </td>
                </tr>	
                <?php $i++ ?>
            <?php endforeach ?>	
	</tbody>
</table>	