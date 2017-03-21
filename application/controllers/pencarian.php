<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
 	}

	public function index()
	{
		$kota = $this->input->get('kota');
		
		$harga = $this->input->get('harga');
		if($harga == 1){
			$minHarga = 0;
			$maxHarga = 500000;
		}
		else if($harga == 2){
			$minHarga = 500001;
			$maxHarga = 1000000;
		}
		else if($harga == 2){
			$minHarga = 1000001;
			$maxHarga = 1500000;
		}
		else if($harga == 2){
			$minHarga = 1500001;
			$maxHarga = 9999999;
		}

		$tipe = $this->input->get('tipe');
		$kos = $this->input->get('fasilitaskos');
		$kamar = $this->input->get('fasilitaskamar');

		$fasilitaskos = implode(",", $kos);
		$fasilitaskamar = implode(",", $kamar);
	}
	
}
