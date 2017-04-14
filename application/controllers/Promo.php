<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_akun','',TRUE);
	   	$this->load->model('model_promo', '',TRUE);
 	}

 	public function index()
	{
		$tanggal = date("Y-m-d");
		$data['promo'] = $this->model_promo->ambil_promo($tanggal);

		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];


            $this->load->view('template/header_akun_home', $dataAkun);
			$this->load->view('halaman_promo', $data);
			$this->load->view('template/footer');
        }
        else {
            $this->load->view('template/header');
			$this->load->view('halaman_promo', $data);
			$this->load->view('template/footer');
        }
	}
	
}
