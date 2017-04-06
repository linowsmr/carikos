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
			$status = 0;
+			$data['idTransaksi'] = $this->model_transaksi->transaksi($data['idPemesanan'],$data['totalPembayaran'],$status);

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

            $data['idTransaksi'] = $this->model_transaksi->data_transaksi();
  			$data['totalPembayaran'] = $this->model_transaksi->data_transaksi();

			$this->load->view('template/header_akun', $dataAkun);
			$this->load->view('konfirmasi_pembayaran', $data);
			$this->load->view('template/footer');
        }
        else
        	echo "Anda Harus Login Terlebih Dahulu";
	}

	public function konfBayar()
	{
		$idTransaksi = $this->input->post('idTransaksi');
		$norek = $this->input->post('norek');
		$namarek = $this->input->post('namarek');
		$bank = $this->input->post('bank');
		$status = 1;
		
		$cek = $this->model_transaksi->verifikasi($idTransaksi,$norek,$namarek,$bank,$status);
		if($cek != 'Gagal'){
			redirect('home');
		}
		else{
			echo 'Gagal';
		}
	}

	public function daftar()
	{
		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $data['cek'] = $this->model_transaksi->count_transaksi($dataAkun['username']);
            $data['transaksi'] = $this->model_transaksi->ambil_transaksi($dataAkun['username']);

			$this->load->view('template/header_akun', $dataAkun);
			$this->load->view('daftar_transaksi', $data);
			$this->load->view('template/footer');
        }
        else
        	echo "Anda Harus Login Terlebih Dahulu";
	}
}