<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Jpgraph {
	public function radar() {
		include ("jpgraph/jpgraph.php");
		include ("jpgraph/jpgraph_radar.php");

	}
	
	public function bar(){
		include ("jpgraph/jpgraph.php");
		include ("jpgraph/jpgraph_bar.php");
	}

}
?>