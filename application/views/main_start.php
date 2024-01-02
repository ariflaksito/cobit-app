<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# file /views/main_start.php
# created Oct 11, 2012 11:15:47 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h3>Step 1. Mulai Penilaian</h3>
<p>
    Sebelum memulai penilaian maturity model, silahkan isikan Nama Auditor, Email 
    dan Nama Project yang akan dinilai menggunakan aplikasi ini. Setelah itu, 
    pilih proses-proses dalam domain COBIT yang akan dinilai. Selanjutnya isikan
    kuesioner sesuai proses yang dipilih sebelumnya. Dan terakhir akan diperoleh hasil
    nilai maturity model yang dapat di tampilkan dalam bentuk chart.    
</p>

<form action="" method="post">
    <legend>Form Pengisian Project</legend>

    <?php if (isset($sts) && $sts == 1): ?>
        <div class="alert alert-success"><?php echo $msg ?></div>
    <?php elseif (isset($sts) && $sts == 0): ?>
        <div class="alert alert-error"><?php echo $msg ?></div>
    <?php endif ?>

    <label>Nama Lengkap</label>
    <input type="text" name="full_name" class="input-xlarge" value="<?php echo $post['full_name']?>" />

    <div class="control-group">
        <label class="control-label" for="inputIcon">Alamat Email</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input class="input-xlarge" type="text" name="email" value="<?php echo $post['email']?>" />
            </div>
        </div>
    </div>

    <label>Nama Project</label>
    <input type="text" name="project_name" class="input-xxlarge" value="<?php echo $post['project_name']?>" />

    <label class="checkbox"></label>
    <button type="submit" name="go" value="go" class="btn btn-inverse">Lanjutkan</button>
</form>