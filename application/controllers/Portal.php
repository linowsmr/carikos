<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_pencarian','',TRUE);
 	}

 	public function index()
	{
		$dom = new DOMDocument("1.0");
		$node = $dom->createElement("markers");
		$parnode = $dom->appendChild($node);

		header("Content-type: text/xml");

		$portal = $this->model_pencarian->portal();
		foreach($portal as $row){
		  $node = $dom->createElement("marker");
		  $newnode = $parnode->appendChild($node);
		  $newnode->setAttribute("jenisKendaraanPortal",$row->jenisKendaraanPortal);
		  $newnode->setAttribute("latPortal",$row->latPortal);
		  $newnode->setAttribute("lngPortal",$row->lngPortal);
		  $newnode->setAttribute("aksesPortal",$row->aksesPortal);
		  $newnode->setAttribute("waktuBukaPortal",$row->waktuBukaPortal);
		  $newnode->setAttribute("waktuTutupportal",$row->waktuTutupportal);

		// 
		}

		echo $dom->saveXML();
	}
}
