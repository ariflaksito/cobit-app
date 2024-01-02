<?php

# Aplikasi Penilaian Tingkat Kematangan Proses dalam domain COBIT
# digunakan untuk Tesis S2 MTI - STMIK AMIKOM Yogyakarta
# 
# version 1.0
# class graph
# file /controllers/graph.php
# created Nov 8, 2012 4:11:48 PM
# 
# (c)2012, arif.laksito@gmail.com

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mygraph extends CI_Controller {
	
	public function bar_graph($id){
		$this->load->library('jpgraph');
		$this->jpgraph->bar();
		
		$this->load->model(array('project', 'process'));        
        $maturity = $this->process->get_report_value($id);		
		
		$graph = new Graph(count($maturity)*60,300);				
		$graph->SetScale("textint");				
		
		$domain = array();
		$level = array();
		for($i=0; $i<count($maturity); $i++){
			$domain[$i] = $maturity[$i]['process_short_name'];
			$level[$i] = round($maturity[$i]['level']);
			$target[$i] = ($level[$i]<5)?1:0;
		}
		
		$graph->xaxis->SetTickLabels($domain);
		$graph->legend->SetPos(0.03,0.02,'right','top');
		$graph->yaxis->scale->SetGrace(20);
		
		// Create the first bar
		$bplot = new BarPlot($target);		
		$bplot->SetLegend("Target");	
		$bplot->SetColor('red');
				
		 
		// And the second bar
		$bplot2 = new BarPlot($level);		
		$bplot2->SetLegend("Existing");	
		$bplot2->SetColor('blue');
		 
		// Join them in an accumulated (stacked) plot
		$accbplot = new AccBarPlot(array($bplot2,$bplot));
		$accbplot->SetWidth(0.6);
		$graph->Add($accbplot);
		
		$graph->Stroke();
	}
	
	public function radar_graph($id){
		$this->load->library('jpgraph');
		$this->jpgraph->radar();
		
		$this->load->model(array('project', 'process'));        
        $maturity = $this->process->get_report_value($id);		
		
		$domain = array();
		$level = array();
		for($i=0; $i<count($maturity); $i++){
			$domain[$i] = $maturity[$i]['process_short_name'];
			$level[$i] = round($maturity[$i]['level']);			
		}
		
		$graph = new RadarGraph(350,320);
		$graph->SetScale('lin',0,6);
 
		$graph->SetColor("white");
		 
		$graph->SetCenter(0.48,0.55);		
		$graph->axis->SetWeight(1);
		 
		$graph->grid->SetLineStyle("longdashed");
		$graph->grid->SetColor("navy");
		$graph->grid->Show();		
						
		$graph->SetTitles($domain);
		$graph->legend->SetPos(0.03,0.02,'right','top');
				 
		$plot = new RadarPlot($level);				
		$plot->SetLegend("Existing");
		$plot->setFillColor('lightblue');
		$plot->SetColor('blue');		
		$plot->SetLineWeight(3);
		 		
		$graph->Add($plot);
		 		
		$graph->Stroke();
 
	}
	
	public function radar_graph_target($id){
		$this->load->library('jpgraph');
		$this->jpgraph->radar();
		
		$this->load->model(array('project', 'process'));        
        $maturity = $this->process->get_report_value($id);		
		
		$domain = array();
		$level = array();
		for($i=0; $i<count($maturity); $i++){
			$domain[$i] = $maturity[$i]['process_short_name'];
			$level[$i] = round($maturity[$i]['level']);
			$target[$i] = ($level[$i]<5)?$level[$i]+1:$level[$i];
		}
		
		$graph = new RadarGraph(350,320);
		$graph->SetScale('lin',0,6);
 	
		$graph->SetColor("white");

		 
		$graph->SetCenter(0.48,0.55);		
		$graph->axis->SetWeight(1);
		 
		$graph->grid->SetLineStyle("longdashed");
		$graph->grid->SetColor("navy");
		$graph->grid->Show();		
						
		$graph->SetTitles($domain);
		$graph->legend->SetPos(0.03,0.02,'right','top');
		     
		$plot = new RadarPlot($target);				
		$plot->SetLegend("Target");
		$plot->setFillColor('lightred');
		$plot->SetColor("red");		
		$plot->SetLineWeight(3);
		 		
		$graph->Add($plot);
		 		
		$graph->Stroke();
	}	

}

?>