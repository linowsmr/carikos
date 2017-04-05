<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_transaksi','',TRUE);
 	}

	public function index()
	{
		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $data['idPemesanan'] = $this->input->post('pemesanan');
			$data['totalPembayaran'] = $this->input->post('totalPembayaran');

			$this->load->view('template/header_akun', $dataAkun);
			$this->load->view('detail_pembayaran', $data);
			$this->load->view('template/footer');
        }
        else
        	echo "Anda Harus Login Terlebih Dahulu";

	}

	public function konfirmasi()
	{
		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $data['idPemesanan'] = $this->input->post('pemesanan');
			$data['totalPembayaran'] = $this->input->post('totalPembayaran');

			$this->load->view('template/header_akun', $dataAkun);
			$this->load->view('konfirmasi_pembayaran', $data);
			$this->load->view('template/footer');
        }
        else
        	echo "Anda Harus Login Terlebih Dahulu";
	}

	public function konfBayar()
	{
		$idPemesanan = $this->input->post('idPemesanan');
		$totalBayar = $this->input->post('totalBayar');
		$norek = $this->input->post('norek');
		$namarek = $this->input->post('namarek');
		$bank = $this->input->post('bank');
		$status = $this->input->post('status');
		
		$cek = $this->model_transaksi->transaksi($idPemesanan,$totalBayar,$norek,$namarek,$bank,$status);
		if($cek != 'Gagal'){
			redirect('home');
		}
		else{
			echo 'gagal';
		}
	}

}