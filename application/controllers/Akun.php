<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_akun','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_pemesanan','',TRUE);
 	}

 	public function login()
	{
		$this->load->library('session');
    	$username = $this->input->post('akun');
    	$password = $this->input->post('password');

    	$cekAkun = $this->model_akun->cek($username);
    	if($cekAkun > 0){
    		$result = $this->model_akun->login($username, $password);

	    	if($result){
	    		$sess_array = array();
			    foreach($result as $row)
			    {
			    	$sess_array = array(
			        	'username' => $row->username
			        );
			    	$this->session->set_userdata('logged_in_akun', $sess_array);
			    }

			    $dataAkun['username'] = $username;

			    $data['kamar'] = $this->input->post('kamar');
				$data['kos'] = $this->input->post('kos');
				$data['harga'] = $this->input->post('harga');

				$data['akun'] = $this->model_akun->ambil_akun($dataAkun['username']);
				$data['detailKamar'] =  $this->model_kamar->detail_kamar($data['kamar']);
				$data['detailKos'] =  $this->model_kos->detail_kos($data['kos']);
				$data['tipeKos'] =  $this->model_kos->tipe_kos($data['kos']);

				$this->load->view('template/header_akun', $dataAkun);
				$this->load->view('data_pemesanan', $data);
				$this->load->view('template/footer');
	    	}
	    	else
	    		redirect('pemilik/masuk');
    	}
    	else
    		redirect('pemilik/masuk');
	}
	
	public function logout()
    {
    	$this->session->unset_userdata('logged_in_akun');
   		session_destroy();
   		redirect('home/index');
    }

}
