<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class main_process
# file
# created Oct 17, 2012 7:05:14 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h3>Step 2. Pemilihan Proses</h3>
<p>
    Pada tahap ini dilakukan pemilihan proses-proses dalam project <strong>"<?php echo $proj['project_name'] ?>"</strong> 
    yang akan diukur tingkat kematangannya / maturity model level berdasarkan domain dalam COBIT. 
    Silahkan tandai proses-proses dibawah ini berdasarkan pengelompokan domainnya.
</p>

<p>
    <?php echo 'Auditor: ' . $proj['full_name'] . ', Email: ' . $proj['email'] ?><br />
    <?php echo 'Created: ' . date('d M Y, H:i', human_to_unix($proj['project_date'])) ?>
</p>

<form action="" method="post">
    
    <?php if (isset($sts) && $sts == 1): ?>
        <div class="alert alert-success"><?php echo $msg ?></div>
    <?php elseif (isset($sts) && $sts == 0): ?>
        <div class="alert alert-error"><?php echo $msg ?></div>
    <?php endif ?>
            
    <?php
    $px = array();
    foreach($post as $p){
        $px[$p['process_id']] = $p['process_short_name'];
    }
    ?>          
        
    <?php foreach ($dmn as $d): ?>
        <label class="text-success">
            <strong><?php echo $d['domain_short_name'] . ' - ' . $d['domain_name'] ?></strong><br />
            <?php echo $d['domain_desc'] ?>
        </label>    
        <?php foreach ($prs[$d['domain_id']] as $p): ?>
        <label class="checkbox">
            <?php $in = array_search($p['process_short_name'], $px)?>
            <input type="checkbox" name="p[]" <?php if($in):?>checked="checked"<?php endif?>
                   value="<?php echo $p['process_id'].'*'.$p['domain_id']?>"> 
            <?php echo $p['process_short_name'].' - '.$p['process_name']?>
        </label>
    
        <?php endforeach ?>
        <label class="checkbox"></label>
    <?php endforeach ?>
    
    <button type="submit" name="go" value="go" class="btn btn-inverse">Lanjutkan</button>
    <button type="button" class="btn btn-primary" 
        onclick="window.location.href='<?php echo $this->config->item('base_url').'/app/istart/'.$id?>'">
        Kembali</button>
</form>