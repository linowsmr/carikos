<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_pemilik','',TRUE);
 	}

	public function masuk()
	{
		$this->load->view('masuk_pemilik');
	}

	public function login()
	{
		$this->load->library('session');
    	$username = $this->input->post('akun');
    	$password = $this->input->post('password');

    	$result = $this->model_pemilik->login($username, $password);

    	if($result){
    		$sess_array = array();
		    foreach($result as $row)
		    {
		    	$sess_array = array(
		        	'username' => $row->usernamePemilik
		        );
		    	$this->session->set_userdata('logged_in_pemilik', $sess_array);
		    }
		    redirect('pemilik/berhasil');
    	}
    	else
    		echo "Gagal Masuk Session";
	}

	public function daftar()
	{
		$this->load->view('daftar_pemilik');
	}

	public function pendaftaran()
	{
		$this->load->library('session');

		$username = $this->input->post('akun');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');

		$status = $this->model_pemilik->daftar($username, $password, $nama, $email, $telepon);

		if($status == 'Berhasil'){
			$sess_array = array(
	        	'username' => $username
	        );
	    	$this->session->set_userdata('logged_in_pemilik', $sess_array);
	    	redirect('pemilik/berhasil');
		}
		else
			echo "Gagal Masuk Session";
	}

	public function berhasil()
	{
		$session_data = $this->session->userdata('logged_in_pemilik');
   		$username = $session_data['username'];
   		echo "Username Anda: $username";
	}

	public function logout()
    {
    	$this->session->unset_userdata('logged_in_pemilik');
   		session_destroy();
   		redirect('pemilik/masuk');
    }
}
