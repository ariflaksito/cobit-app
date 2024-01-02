<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class main_confirm
# file
# created Oct 17, 2012 7:37:51 PM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h3>Step 3. Konfirmasi Proses</h3>
<p>
Pada tahap ini memberikan informasi proses-proses yang telah dipilih pada tahap sebelumnya.<br />
Berikut disajikan informasi sebelum dilakukan penilain terhadap proses-proses tersebut.
</p>

<p>
    <?php echo 'Project: ' . $proj['project_name']?><br />
    <?php echo 'Auditor: ' . $proj['full_name'] . ', Email: ' . $proj['email'] ?><br />
    <?php echo 'Created: ' . date('d M Y, H:i', human_to_unix($proj['project_date'])) ?>
</p>

<p>
    <span class="text-success">
        <strong>Proses-proses yang akan diukur tingkat kematangannya</strong>
    </span><br />
    
    <?php foreach($proc as $p):?>
    <i class="icon-ok"></i> <?php echo $p['process_short_name'].' - '.$p['process_name']?><br />    
    <?php endforeach?>
    <br />
    Jumlah: <?php echo count($proc)?> Proses<br /><br />
    <button type="button" class="btn btn-inverse"
        onclick="window.location.href='<?php echo $this->config->item('base_url').'app/nilai/'.$id.'/0'?>'">
        Lanjut Penilaian</button>
    <button type="button" class="btn btn-primary" 
        onclick="window.location.href='<?php echo $this->config->item('base_url').'app/process/'.$id?>'">
        Kembali</button>
</p>    