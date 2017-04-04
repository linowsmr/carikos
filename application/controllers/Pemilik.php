<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilik extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_pemilik','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
 	}

	public function masuk()
	{
		$this->load->view('template/header');
		$this->load->view('masuk_pemilik');
		$this->load->view('template/footer');
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
		    redirect('pemilik/beranda');
    	}
    	else
    		echo "Gagal Masuk Session";
	}

	public function daftar()
	{
		$this->load->view('template/header');
		$this->load->view('daftar_pemilik');
		$this->load->view('template/footer');
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
	    	redirect('pemilik/beranda');
		}
		else
			echo "Gagal Masuk Session";
	}

	public function beranda()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $dataPemilik['username'] = $session_data['username'];

            $data['fasilitas'] = $this->model_kos->fasilitas();
            $data['tipe'] = $this->model_kos->tipe();
            $data['parkir'] = $this->model_kos->parkiran();

            $data['jumlah'] = $this->model_kos->count_list($dataPemilik['username']);
            $data['kos'] = $this->model_kos->list_kos($dataPemilik['username']);

            $this->load->view('template/header_pemilik', $dataPemilik);
			$this->load->view('beranda_pemilik', $data);
			$this->load->view('template/footer');
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function logout()
    {
    	$this->session->unset_userdata('logged_in_pemilik');
   		session_destroy();
   		redirect('pemilik/masuk');
    }
}
