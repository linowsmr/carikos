<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_akun','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_pemesanan','',TRUE);
 	}

	public function index()
	{
		$data['kamar'] = $this->input->post('kamar');
		$data['kos'] = $this->input->post('kos');
		$data['harga'] = $this->input->post('harga');
		
		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

			$data['akun'] = $this->model_akun->ambil_akun($dataAkun['username']);
			$data['detailKamar'] =  $this->model_kamar->detail_kamar($data['kamar']);
			$data['detailKos'] =  $this->model_kos->detail_kos($data['kos']);
			$data['tipeKos'] =  $this->model_kos->tipe_kos($data['kos']);

			$this->load->view('template/header_akun', $dataAkun);
			$this->load->view('data_pemesanan', $data);
			$this->load->view('template/footer');
        }
        else {
        	$this->load->view('template/header');
			$this->load->view('masuk_akun', $data);
			$this->load->view('template/footer');
		}
	}

	public function pesan()
	{
		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $username = $this->input->post('username');
			$data['nama'] = $this->input->post('nama');
			$kodeTelepon = "+62";
			$data['telepon'] = $kodeTelepon.$this->input->post('telepon');
			$data['email'] = $this->input->post('email');
			$data['masuk'] = $this->input->post('masuk');
			$data['keluar'] = $this->input->post('keluar');

			$masuk = date_create($data['masuk']);
			$keluar = date_create($data['keluar']);

			$diff = date_diff($masuk, $keluar);

			$tahun = $diff->format("%y");
			$bulan = $diff->format("%m");
			$hari = $diff->format("%d");
			
			$data['durasi'] = 0;
			if($tahun > 0)
				$data['durasi'] = $data['durasi'] + $tahun*12;
			if($bulan > 0)
				$data['durasi'] = $data['durasi'] + $bulan;
			if($hari > 0)
				$data['durasi'] = $data['durasi'] + 1;
			if($data['durasi'] < 1)
				echo "Salah Input Tanggal";

			$idKamar = $this->input->post('kamar');
			$idKos = $this->input->post('kos');
			$data['harga'] = $this->input->post('harga');
			$data['totalPembayaran'] = $data['durasi']*$data['harga'];

			$data['detailKamar'] =  $this->model_kamar->detail_kamar($idKamar);
			$data['detailKos'] =  $this->model_kos->detail_kos($idKos);
			$data['tipeKos'] =  $this->model_kos->tipe_kos($idKos);
			
			$data['idPemesanan'] = $this->model_pemesanan->tambah_pemesanan($data['masuk'], $data['keluar'], $data['durasi'], $data['harga'], $username, $idKamar);

			if($data['idPemesanan'] != "Gagal"){
				$this->load->view('template/header_akun', $dataAkun);
				$this->load->view('detail_pemesanan', $data);
				$this->load->view('template/footer');
			}
			else
				echo "Gagal";
        }
        else
        	echo "Anda Harus Login Terlebih Dahulu";

		
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
