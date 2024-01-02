<?php
# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# file views/main_nilai.php
# created Oct 18, 2012 11:08:10 AM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>


<script type="text/javascript">
    $(document).ready(function(){	
    <?php foreach ($matr as $m):?>
                                     
        function sub_<?php echo $m['maturity_model_id']?>(){
            var tmp = 0;
            <?php foreach ($st[$m['maturity_model_id']] as $s):?>  
            tmp  = tmp + parseFloat($("#rst_<?php echo $s['statement_id']?>").html());
            <?php endforeach?>
            
            return Math.round(tmp*100)/100;
        }
        
        <?php $total = 0;?>    
        <?php foreach ($st[$m['maturity_model_id']] as $s):?>  
		
		<?php $total += $s['report_value']?>
		
        $("#rst_<?php echo $s['statement_id']?>").text(<?php echo $s['report_value']?>);
                        
        $("#st_a_<?php echo $s['statement_id']?>").click(function () {
            $.ajax({url:'<?php echo $this->config->site_url().'load/st/'.$s['statement_id'].'/'.$pc['audit_id'].'/0'?>'});            
            $("#rst_<?php echo $s['statement_id']?>").text("0");                            
                       
            $("#f_<?php echo $m['maturity_model_id']?>").text(sub_<?php echo $m['maturity_model_id']?>());
        });
        
        $("#st_b_<?php echo $s['statement_id']?>").click(function () {
            $.ajax({url:'<?php echo $this->config->site_url().'load/st/'.$s['statement_id'].'/'.$pc['audit_id'].'/33'?>'});            
            $("#rst_<?php echo $s['statement_id']?>").text("0.33");     
                        
            $("#f_<?php echo $m['maturity_model_id']?>").text(sub_<?php echo $m['maturity_model_id']?>());
        });
        
        $("#st_c_<?php echo $s['statement_id']?>").click(function () {
            $.ajax({url:'<?php echo $this->config->site_url().'load/st/'.$s['statement_id'].'/'.$pc['audit_id'].'/66'?>'});            
            $("#rst_<?php echo $s['statement_id']?>").text("0.66");       
                        
            $("#f_<?php echo $m['maturity_model_id']?>").text(sub_<?php echo $m['maturity_model_id']?>());
        });
        
        $("#st_d_<?php echo $s['statement_id']?>").click(function () {
            $.ajax({url:'<?php echo $this->config->site_url().'load/st/'.$s['statement_id'].'/'.$pc['audit_id'].'/1'?>'});            
            $("#rst_<?php echo $s['statement_id']?>").text("1");        
                        
            $("#f_<?php echo $m['maturity_model_id']?>").text(sub_<?php echo $m['maturity_model_id']?>());
        });
        <?php endforeach ?>
        
        $("#f_<?php echo $m['maturity_model_id']?>").text(<?php echo $total?>);
                        
    <?php endforeach ?>
    });
</script>

<h3>Step 4. Penilaian Proses</h3>
<p>
    <strong><span class="text-success"><?php echo $pc['process_short_name'] . ' - ' . $pc['process_name'] ?></span></strong><br />    
    Penilaian Proses ke <strong><?php echo $pid + 1 ?></strong> dari <strong><?php echo count($proc) ?></strong>
</p>

<?php

$atts = array(
	'width'      => '360',
	'height'     => '250',
	'scrollbars' => 'no',
	'status'     => 'no',
	'resizable'  => 'no',
	'screenx'    => '0',
	'screeny'    => '0'
);

?>

<?php foreach ($matr as $m): ?>
    <p><strong><span class="text-error">
                Pernyataan untuk <?php echo $pc['process_short_name'] ?> Maturity Model: 
                <?php echo $m['maturity_model_level'] . ' (' . $m['maturity_model_name'] . ')' ?>
            </span></strong></p>        

    <table class="table table-bordered">     
        <?php $i = 1 ?>
        <?php foreach ($st[$m['maturity_model_id']] as $s): ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
                	<?php echo $s['statement_name']?>
                	<?php if(substr($_SERVER['REMOTE_ADDR'],0,10)=='127.0.0'):?>
                	<?php echo anchor_popup('load/et/'.$s['statement_id'], '<i class="icon-pencil"></i>', $atts);?>	                		
                	<?php endif?>
                </td>
                <td width="8%">
                    <label class="radio">
                    	<?php $ca = ($s['report_value']==0 && isset($s['report_value']))?"checked='checked'":""?>
                        <input type="radio" name="st_<?php echo $s['statement_id']?>" 
                               value="0" id="st_a_<?php echo $s['statement_id']?>" <?php echo $ca?> />
                        <abbr title="Tidak Benar Sama Sekali">TBS</abbr>
                    </label>                
                </td>
                <td width="8%">
                    <label class="radio">
                    	<?php $cb = ($s['report_value']==0.33)?"checked='checked'":""?>
                        <input type="radio" name="st_<?php echo $s['statement_id']?>" 
                               value="0.33" id="st_b_<?php echo $s['statement_id']?>" <?php echo $cb?> />
                        <abbr title="Ada Benarnya">AB</abbr>
                    </label> 
                </td>
                <td width="8%">
                    <label class="radio">
                    	<?php $cc = ($s['report_value']==0.66)?"checked='checked'":""?>
                        <input type="radio" name="st_<?php echo $s['statement_id']?>" 
                               value="0.66" id="st_c_<?php echo $s['statement_id']?>" <?php echo $cc?> />
                        <abbr title="Sebagian Besar Benar">SBB</abbr>
                    </label> 
                </td>
                <td width="8%">
                    <label class="radio">
                    	<?php $cd = ($s['report_value']==1)?"checked='checked'":""?>
                        <input type="radio" name="st_<?php echo $s['statement_id']?>" 
                               value="1" id="st_d_<?php echo $s['statement_id']?>" <?php echo $cd?> />
                        <abbr title="Sepenuhnya Benar">SB</abbr>
                    </label> 
                </td>
                <td width="10%" style="text-align:right">
                    <span id="rst_<?php echo $s['statement_id']?>">0</span>
                </td>
            </tr>     
            <?php $i++ ?>
        <?php endforeach ?>
        <tr>
            <td colspan="6"><div class="pull-right">Nilai Total</div></td>
            <td style="text-align:right"><span id="f_<?php echo $m['maturity_model_id']?>"></span></td>
        </tr>
    </table>
    <span class="label">TBS - Tidak Benar Sama Sekali</span>
    <span class="label">AB - Ada Benarnya</span>
    <span class="label">SBB - Sebagian Besar Benar</span>
    <span class="label">SB - Sepenuhnya Benar</span>
    <br /><br />
<?php endforeach ?>

<button type="button" class="btn btn-inverse" 
        onclick="window.location.href='<?php echo $this->config->item('base_url').'app/nilai/'.$id.'/'.($pid+1)?>'">
        Lanjutkan Penilaian</button>