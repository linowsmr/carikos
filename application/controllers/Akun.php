<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function logout()
    {
    	$this->session->unset_userdata('logged_in_akun');
   		session_destroy();
   		redirect('home/index');
    }

}
