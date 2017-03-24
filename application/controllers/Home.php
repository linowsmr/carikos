<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
 	}

	public function index()
	{
		$data['fasilitas'] = $this->model_kos->fasilitas();
        $data['tipe'] = $this->model_kos->tipe();
	    $data['fasilitaskamar'] = $this->model_kamar->fasilitas();


		$this->load->view('template/header');
		$this->load->view('homepage', $data);
		$this->load->view('template/footer');
	}

}
