<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_pencarian', '',TRUE);
 	}

	public function index()
	{
		$data['fasilitas'] = $this->model_kos->fasilitas();
        $data['tipe'] = $this->model_kos->tipe();
	    $data['fasilitaskamar'] = $this->model_kamar->fasilitas();
	    $data['jurusan'] = $this->model_pencarian->list_jurusan();

		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $data['akun'] = 1;
            $this->load->view('template/header_akun_home', $dataAkun);
			$this->load->view('homepage', $data);
			$this->load->view('template/footer');
        }
        else {
        	$data['akun'] = 0;
            $this->load->view('template/header');
			$this->load->view('homepage', $data);
			$this->load->view('template/footer');
        }
	}

}
