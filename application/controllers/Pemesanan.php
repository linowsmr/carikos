<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_pemesanan','',TRUE);
 	}

	public function index()
	{
		$idKamar = $this->input->post('kamar');
		$idKos = $this->input->post('kos');
		$data['harga'] = $this->input->post('harga');

		$data['detailKamar'] =  $this->model_kamar->detail_kamar($idKamar);
		$data['detailKos'] =  $this->model_kos->detail_kos($idKos);
		$data['tipeKos'] =  $this->model_kos->tipe_kos($idKos);

		$this->load->view('template/header');
		$this->load->view('data_pemesanan', $data);
		$this->load->view('template/footer');
	}

	public function pesan()
	{
		$username = $this->input->post('username');
		$data['nama'] = $this->input->post('nama');
		$kodeTelepon = "+62";
		$data['telepon'] = $kodeTelepon.$this->input->post('telepon');
		$data['email'] = $this->input->post('email');
		$data['durasi'] = $this->input->post('durasi');

		$idKamar = $this->input->post('kamar');
		$idKos = $this->input->post('kos');
		$data['harga'] = $this->input->post('harga');
		$data['totalPembayaran'] = $data['durasi']*$data['harga'];

		$data['detailKamar'] =  $this->model_kamar->detail_kamar($idKamar);
		$data['detailKos'] =  $this->model_kos->detail_kos($idKos);
		$data['tipeKos'] =  $this->model_kos->tipe_kos($idKos);

		$data['idPemesanan'] = $this->model_pemesanan->tambah_pemesanan($data['durasi'], $data['harga'], $username, $idKamar);

		if($data['idPemesanan'] != "Gagal"){
			$this->load->view('template/header');
			$this->load->view('detail_pemesanan', $data);
			$this->load->view('template/footer');
		}
		else
			echo "Gagal";
	}

	public function pemilik()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $dataPemilik['username'] = $session_data['username'];
            $dataPemilik['notifikasi'] = $this->model_pemesanan->count_pemesanan($dataPemilik['username']);
            
            $data['cek'] = $this->model_pemesanan->count_pemesanan($dataPemilik['username']);
            $data['pemesanan'] = $this->model_pemesanan->ambil_pemesanan($dataPemilik['username']);

            $this->load->view('template/header_pemilik', $dataPemilik);
			$this->load->view('pemesanan_pemilik', $data);
			$this->load->view('template/footer');
        }
        else {
            redirect('pemilik/masuk');
        }
	}
}
