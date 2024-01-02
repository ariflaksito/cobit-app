<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT

# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta

# 

# version 1.0

# class proj_report

# file /views/proj_report.php

# created Nov 4, 2012 09:55:12 AM

# 

# (c)2012, arif.laksito@gmail.com



if (!defined('BASEPATH'))

    exit('No direct script access allowed');

?>



<script>

    $(document).ready(function(){

    	

    	$('#rec').click(function(){

            $('#rec_modal').modal();

        });

    	

        <?php for($i=0; $i<count($maturity); $i++):?>

        $('#tmodal_<?php echo $i?>').click(function(){

            $('#modal_<?php echo $i?>').modal();

        });        

        

        $('#rmodal_<?php echo $i?>').click(function(){

            $('#m_isi_<?php echo $i?>').modal();

        });

        <?php endfor?>

    });



</script>



<h3>Laporan Penilaian</h3>

<p>

    Berikut Laporan penilaian level kematangan tiap proses di COBIT

    dari tahap pengisian kuesioner sebelumnya pada project "<?php echo $proj['project_name'] ?>"

</p>

<p>

	Keterangan: &nbsp;&nbsp;&nbsp;  

	<a><i class="icon-align-justify"></i></a> Lihat Detail Penilaian &nbsp;&nbsp;&nbsp;

	<a><i class="icon-pencil"></i></a> Isi Rekomendasi

</p>

<table class="table table-bordered table-hover table-condensed">

    <thead>

        <tr class="warning">

            <th>No</th>

            <th>Proses</th>

            <th>Maturity Level</th>

            <th>Pembulatan</th>		

            <th></th>		            

        </tr>

    <thead>    

    <tbody>

        <?php $no = 1 ?>    

        <?php foreach ($maturity as $mt): ?>

            <tr>

                <td><?php echo $no ?></td>

                <td><?php echo $mt['process_short_name'] . ' - ' . $mt['process_name'] ?></td>

                <td style="text-align: right"><?php echo $mt['level'] ?></td>

                <td style="text-align: right"><?php echo round($mt['level']) ?></td>

                <td style="text-align: center">

                	<a href="#" id="tmodal_<?php echo $no-1?>"><i class="icon-align-justify"></i></a>

                	&nbsp;&nbsp;&nbsp;

                	<a href="#" id="rmodal_<?php echo $no-1?>"><i class="icon-pencil"></i></a>

                </td>                

            </tr>

            <?php $no++ ?>    

        <?php endforeach ?>

    </tbody>    

</table>



<div id="rec_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<h4 id="myModalLabel">Rekomendasi Penilaian "<?php echo $proj['project_name'] ?>"</h4>		

	</div>

	<div class="modal-body">

		<ol type="1">

		<?php for($x=0; $x<count($maturity); $x++):?>

			<li style="margin-bottom: 10px">

				<strong>

				<?php echo $maturity[$x]['process_short_name'].' - '.$maturity[$x]['process_name']?>

				</strong><br />

				<?php echo $maturity[$x]['recc']?>

			</li>

		<?php endfor?>

		</ol>	

	</div>

</div>	



<?php echo anchor('app/nilai/'.$proj['project_id'].'/0', '&laquo; Nilai Ulang Proses')?>

&nbsp;&nbsp;&nbsp;

<a href="#" id="rec"><i class="icon-file"></i> Lihat Rekomendasi</a>



<?php

	$atts = array(

    	'width'      => '800',

		'height'     => '600',

        'scrollbars' => 'yes',

		'status'     => 'yes',

		'resizable'  => 'yes',

		'screenx'    => '0',

		'screeny'    => '0'

	);

?>



<h3>Cetak Laporan Penilaian</h3>

<p>Anda dapat mencetak hasil perhitungan dan hasil penilaian tiap-tiap proses COBIT</p>

<i class="icon-print"></i>

	<?php echo anchor_popup('app/print_maturity/'.$proj['project_id'], 'Cetak Perhitungan Hasil Maturity Model', $atts)?>

	<br />

	

<i class="icon-print"></i>

	<?php echo anchor_popup('app/print_process/'.$proj['project_id'], 'Cetak Hasil Penilaian tiap-tiap Proses COBIT', $atts)?>

	<br />



 

<?php for($j=0; $j<count($maturity); $j++):?>



<div id="m_isi_<?php echo $j?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">

		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		<h4 id="myModalLabel">Pengisian Rekomendasi dari Proses<br /><?php echo $maturity[$j]['process_short_name'].' - '.$maturity[$j]['process_name']?></h4>		

	</div>

	<div class="modal-body">

		<form action="" method="post">

			<input type="hidden" name="audit_id" value="<?php echo $maturity[$j]['audit_id']?>" />

			<textarea name="recc" rows="10" cols="50" style="width: 90%"><?php echo $maturity[$j]['recc']?></textarea>

			<button class="btn btn-success" name="btn_recc">Simpan</button>

		</form>

	</div>

</div>	

	

	

<div id="modal_<?php echo $j?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

<h4 id="myModalLabel">Detail Laporan dari Proses<br /><?php echo $maturity[$j]['process_short_name'].' - '.$maturity[$j]['process_name']?></h4>

</div>

<div class="modal-body">



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

                <th colspan="2" style="text-align:right">Total Maturity Model Value</th>

                <th style="text-align:right"><?php echo $maturity[$j]['level']?></th>

            </tr> 

        </tbody>    

    </table>    

    

</div>

</div>

<?php endfor?>



<h3>Grafik Laporan Maturity Model</h3>

<p>Grafik laporan penilaian Maturity Level berikut ditampilkan dalam bentuk Radar Chart dan Bar Chart</p>

<h4>Radar Chart</h5>

<img src="<?php echo base_url('mygraph/radar_graph/'.$proj['project_id'])?>" /> &nbsp; 

<img src="<?php echo base_url('mygraph/radar_graph_target/'.$proj['project_id'])?>" />



<br /><br /><br />



<h4>Bar Chart</h5>

<img src="<?php echo base_url('mygraph/bar_graph/'.$proj['project_id'])?>" />



<!--

<pre>

<?php print_r($maturity) ?>

</pre>

-->