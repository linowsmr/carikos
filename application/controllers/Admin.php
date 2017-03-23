<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_admin','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_pemilik','',TRUE);
 	}
	public function login(){
		$this->load->library('session');
		$username = $this->input->post('username');
    	$password = $this->input->post('password');

    	$result = $this->model_admin->login($username, $password);

    	if($result){
    		$sess_array = array();
		    foreach($result as $row)
		    {
		    	$sess_array = array(
		        	'username' => $row->username
		        );
		    	$this->session->set_userdata('logged_in_admin', $sess_array);
		    }
		    redirect('admin/beranda');
    	}
    	else
    		echo "Gagal Masuk Session";
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function beranda(){
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $data['kos'] = $this->model_kos->jumlahKos();
            $data['kamar'] = $this->model_kos->jumlahKamar();
            $data['pemilik'] = $this->model_pemilik->jumlahPemilik();

            $this->load->view('admin/admheader', $nama);
            $this->load->view('admin/index', $data);
        }
        else {
            redirect('admin');
        }
	}

	public function logout()
    {
    	$this->session->unset_userdata('logged_in_admin');
   		session_destroy();
   		redirect('admin');
    }
    public function lihatKos()
	{
		$data['kos'] = $this->model_kos->lihatKos();
		$this->load->view('admin/admheader');
		$this->load->view('admin/indekos', $data);
	}
	public function reservasi()
	{
		$this->load->view('admin/admheader');
		$this->load->view('admin/reservasi');
	}
	public function trans()
	{
		$this->load->view('admin/admheader');
		$this->load->view('admin/transaksi');
	}
	public function lapkeu()
	{
		$this->load->view('admin/admheader');
		$this->load->view('admin/laporan');
	}
}