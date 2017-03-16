<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_admin','',TRUE);

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
            $data['username'] = $session_data['username'];

            $this->load->view('admin/admheader');
        }
        else {
            redirect('admin');
        }
	}
}