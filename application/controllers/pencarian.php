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
		$tipe = $this->input->get('tipe');
		$kos = $this->input->get('fasilitaskos');
		$kamar = $this->input->get('fasilitaskamar');

		$fasilitaskos = implode(",", $kos);
		$fasilitaskamar = implode(",", $kamar);
	}
	
}
