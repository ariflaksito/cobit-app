<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class main_report
# file /views/main_report.php
# created Oct 11, 2012 11:44:12 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h3>Laporan Penilaian</h3>
<p>
    Untuk melihat daftar project yang pernah anda inputkan menggunakan aplikasi ini, silahkan isikan alamat email anda. 
    Alamat email sesuai dengan email yang anda gunakan saat mulai menggunakan aplikasi ini.
</p>
<form action="" method="post">

    <?php if (isset($msg)): ?>        
        <div class="alert alert-error"><?php echo $msg ?></div>
    <?php endif ?>

    <div class="control-group">        
        <div class="controls">
            <div class="input-prepend input-append">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input class="input-xlarge" type="text" name="email" value="" /> &nbsp;
                <button type="submit" name="go" value="go" class="btn">Check</button>
            </div>			
        </div>		
    </div>
</form>

<?php if (!empty($proj)): ?>
    <h3>Daftar Project</h3>
    <p>Berikut daftar project dengan email <?php echo $post['email'] ?></p>
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
            <?php $i = 1 ?>
        <tbody>
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
<?php endif?>