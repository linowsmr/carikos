<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_pencarian','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_cluster','',TRUE);
	   	$this->load->model('model_jurusan','',TRUE);
 	}

 	public function index()
 	{
 		$_SESSION['kota'] = strtolower($this->input->get('kota'));
		
		$harga = $this->input->get('harga');
		if($harga == 1){
			$_SESSION['minHarga'] = 0;
			$_SESSION['maxHarga'] = 500000;
		}
		else if($harga == 2){
			$_SESSION['minHarga'] = 500001;
			$_SESSION['maxHarga'] = 1000000;
		}
		else if($harga == 3){
			$_SESSION['minHarga'] = 1000001;
			$_SESSION['maxHarga'] = 1500000;
		}
		else if($harga == 4){
			$_SESSION['minHarga'] = 1500001;
			$_SESSION['maxHarga'] = 9999999;
		}

		$_SESSION['tipe'] = $this->input->get('tipe');
		$kos = $this->input->get('fasilitaskos');
		$kamar = $this->input->get('fasilitaskamar');

		date_default_timezone_set("Asia/Bangkok");
		$masuk = date_create($this->input->get('masuk'));
		$keluar = date_create($this->input->get('keluar'));

		$diff = date_diff($masuk, $keluar);
		$interval = $diff->format("%R");

		if($interval == "-"){
			$_SESSION['pesan'] = "Tanggal Tidak Memenuhi";
			redirect('home/index');
			
		}
		
		$_SESSION['tglMasuk'] = $this->input->get('masuk');
		$_SESSION['tglKeluar'] = $this->input->get('keluar');
		$_SESSION['jurusanDipilih'] = $this->input->get('jurusan');
		
		if($this->input->get('jurusan') != ""){
			$_SESSION['jurusanDipilih'] = $this->input->get('jurusan');

			$_SESSION['fasilitaskos'] = implode(",", $kos);
			$_SESSION['fasilitaskamar'] = implode(",", $kamar);
			
			redirect('pencarian/proses');
		}
		else{
			$_SESSION['jurusanDipilih'] = "";
			redirect('pencarian/hasil');
		}
 	}

 	public function proses()
	{
		$cluster = $this->model_cluster->ambil_cluster();
		foreach($cluster as $row){
			$cekNilai = $this->model_jurusan->cek_nilai($row->idCluster, $_SESSION['jurusanDipilih']);
			
			if($cekNilai == 0) {
				$jurusan = $this->model_jurusan->ambil_jurusan($_SESSION['jurusanDipilih']);
				foreach ($jurusan as $row2) {
					$data['idCluster'] = $row->idCluster;
					$latlong = substr($row->latLngCluster, 1, -1);
			        $coord = explode(", ", $latlong);
			        $data['latCluster'] = $coord[0];
			        $data['lngCluster'] = $coord[1];

					$data['idJurusan'] = $row2->idJurusan;
					$data['latJurusan'] = $row2->latJurusan;
					$data['lngJurusan'] = $row2->lngJurusan;
					break 2;	
				}
			}
		}
		
		if(isset($data)){
			$this->load->view('template/header-2');
			$this->load->view('jarak_jurusan', $data);
			$this->load->view('template/footer-2');	
		}
		else{
			redirect('pencarian/hasil');
		}
	}

	public function hasil()
	{
		$kota = $_SESSION['kota'];
		$minHarga = $_SESSION['minHarga'];
		$maxHarga = $_SESSION['maxHarga'];
		$tipe = $_SESSION['tipe'];
		$fasilitaskos = $_SESSION['fasilitaskos'];
		$fasilitaskamar = $_SESSION['fasilitaskamar'];
		$jurusanDipilih = $_SESSION['jurusanDipilih'];

		$nilaiDestinasi = 0;

		$hasilPencarian = $this->model_pencarian->pencarian($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);

		$cluster = $this->model_cluster->ambil_cluster();
		foreach($cluster as $row){
			$idCluster = $row->idCluster;
			
			$jarakMinimarket = $this->model_cluster->jarak_destinasi($idCluster, 1);
			$jarakSupermarket = $this->model_cluster->jarak_destinasi($idCluster, 2);

			if($jarakMinimarket < $jarakSupermarket){
				$jarakMarket = $jarakMinimarket;
			} else if ($jarakMinimarket > $jarakSupermarket) {
				$jarakMarket = $jarakSupermarket;
			} else if ($jarakMinimarket == $jarakSupermarket){
				$jarakMarket = $jarakMinimarket;
			}

			foreach($jarakMarket as $row){
				$jarakFinalMarket = $row->jarakDestinasi;
				$bobotMarket = 0.16;

				if($jarakFinalMarket <= 2)
					$nilaiDestinasi = $nilaiDestinasi + 100*$bobotMarket;
				else if($jarakFinalMarket > 2 && $jarakFinalMarket <=3)
					$nilaiDestinasi = $nilaiDestinasi + 75*$bobotMarket;
				else if($jarakFinalMarket > 3 && $jarakFinalMarket <=4)
					$nilaiDestinasi = $nilaiDestinasi + 50*$bobotMarket;
				else if($jarakFinalMarket > 4 && $jarakFinalMarket <=5)
					$nilaiDestinasi = $nilaiDestinasi + 25*$bobotMarket;
				else if($jarakFinalMarket > 5)
					$nilaiDestinasi = $nilaiDestinasi + 0*$bobotMarket;
			}

			$jarakMasjid = $this->model_cluster->jarak_destinasi($idCluster, 3);

			foreach($jarakMasjid as $row){
				$jarakFinalMasjid = $row->jarakDestinasi;
				$bobotTempatIbadah = 0.05;

				if($jarakFinalMasjid <= 2)
					$nilaiDestinasi = $nilaiDestinasi + 100*$bobotTempatIbadah;
				else if($jarakFinalMasjid > 2 && $jarakFinalMarket <=3)
					$nilaiDestinasi = $nilaiDestinasi + 75*$bobotTempatIbadah;
				else if($jarakFinalMasjid > 3 && $jarakFinalMarket <=4)
					$nilaiDestinasi = $nilaiDestinasi + 50*$bobotTempatIbadah;
				else if($jarakFinalMasjid > 4 && $jarakFinalMarket <=5)
					$nilaiDestinasi = $nilaiDestinasi + 25*$bobotTempatIbadah;
				else if($jarakFinalMasjid > 5)
					$nilaiDestinasi = $nilaiDestinasi + 0*$bobotTempatIbadah;
			}
			$this->model_cluster->nilai_destinasi($idCluster, $nilaiDestinasi);
			
			$nilaiDestinasi = 0;
		}
		
		$data['bp'] = $this->model_pencarian->bp();

		foreach($hasilPencarian as $row){
			$idKos = $row->idKos;
			$idKamar = $row->idKamar;
			$nilaiParkiranPenjagaKos = $row->nilaiParkiranPenjagaKos;
			$nilaiFasilitas = $row->nilaiFasilitasKamar;

			$luasParkiran = $this->model_cluster->luas_parkiran($idKos);
			$bobotLuasParkiran = 0.08;
			foreach($luasParkiran as $row){
				$luas = $row->idParkiranKos;
				if($luas == 1)
					$nilaiLuasParkir = 100*$bobotLuasParkiran;
				else if($luas == 2)
					$nilaiLuasParkir = 75*$bobotLuasParkiran;
				else if($luas == 3)
					$nilaiLuasParkir = 50*$bobotLuasParkiran;
				else if($luas == 4)
					$nilaiLuasParkir = 25*$bobotLuasParkiran;
				else if($luas == 5)
					$nilaiLuasParkir = 0*$bobotLuasParkiran;
			}

			$penjagaKos = $this->model_cluster->penjaga_kos($idKos);
			$bobotPenjagaKos = 0.02;
			if($penjagaKos == 1)
				$nilaiPenjagaKos = 100*$bobotPenjagaKos;
			else
				$nilaiPenjagaKos = 0*$bobotPenjagaKos;

			$nilaiParkiranPenjaga = $nilaiLuasParkir + $nilaiPenjagaKos;
			$this->model_cluster->update_nilai_kos($idKos, $nilaiParkiranPenjaga);
			
			$fasilitas = $this->model_cluster->fasilitas_lengkap($idKamar);
			$bobotFasilitasKamar = 0.35;
			foreach($fasilitas as $row){
				$fasilitasKamar = $row->fasilitasTiga;
				if($fasilitasKamar == 3)
					$nilaiFasilitasKamar = 100*$bobotFasilitasKamar;
				else if($fasilitasKamar == 2)
					$nilaiFasilitasKamar = 50*$bobotFasilitasKamar;
				else
					$nilaiFasilitasKamar = 0*$bobotFasilitasKamar;
			}
			$this->model_cluster->update_nilai_kamar($idKamar, $nilaiFasilitasKamar);
			
		}

		if($jurusanDipilih != ""){
			$data['rekomendasi'] = $this->model_pencarian->pencarian_jurusan($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar, $jurusanDipilih);
			$data['hasil'] = $this->model_pencarian->pencarian_jurusan_semua($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar, $jurusanDipilih);

			$data['idJurusan'] = $jurusanDipilih;
		}
		else{
			$data['rekomendasi'] = $this->model_pencarian->pencarian($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);
			$data['hasil'] = $this->model_pencarian->pencarian_semua($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);
			$data['idJurusan'] = 0;
		}

		$data['kamarTerpakai'] = $this->model_kamar->terpakai();
		$tanggalMasuk = date_create_from_format('Y-m-d', $_SESSION['tglMasuk']);
		$tanggalKeluar = date_create_from_format('Y-m-d', $_SESSION['tglKeluar']);
		
		$data['tglMasuk'] = $tanggalMasuk->format("m");
		$data['tglKeluar'] = $tanggalKeluar->format("m");
		
		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $this->load->view('template/header_akun', $dataAkun);
			$this->load->view('hasil_pencarian', $data);
			$this->load->view('template/footer');
        }

        else {
        	$this->load->view('template/header');
			$this->load->view('hasil_pencarian', $data);
			$this->load->view('template/footer');
        }
	}

	public function lihatKamar()
	{
		$idKamar = $this->input->post('idKamar');
		$idKos = $this->input->post('idKos');
		$data['jmlKamar'] = $this->input->post('jmlKamar');
		$data['harga'] = $this->input->post('hargaKamar');
		
		$data['detailKos'] =  $this->model_kos->detail_kos($idKos);
		foreach($data['detailKos'] as $row){
			$idCluster = $row->idCluster;
		}

		if($this->input->post('idJurusan') != 0){
			$data['jurusan'] = $this->model_jurusan->latlng_jurusan($this->input->post('idJurusan'), $idCluster);
		}

		$data['fasilitasKos'] =  $this->model_kos->fasilitas_kos_min_penjaga($idKos);
		
		$cekPenjagaKos = $this->model_kos->cek_penjaga_kos($idKos);
		if($cekPenjagaKos > 0)
			$data['penjagaKos'] = "Ya";
		else if($cekPenjagaKos <= 0)
			$data['penjagaKos'] = "Tidak";

		$data['tipeKos'] =  $this->model_kos->tipe_kos($idKos);
		$data['fotoKos'] =  $this->model_kos->list_foto($idKos);
		$data['detailKamar'] =  $this->model_kamar->detail_kamar($idKamar);
		$data['fasilitasKamar'] =  $this->model_kamar->fasilitas_kamar($idKamar);
		$data['fotoKamar'] =  $this->model_kamar->list_foto($idKamar);

		$data['minimarket'] = $this->model_cluster->jarak_destinasi($idCluster, 1);
		$data['supermarket'] = $this->model_cluster->jarak_destinasi($idCluster, 2);
		$data['masjid'] = $this->model_cluster->jarak_destinasi($idCluster, 3);

		if(!empty($this->session->userdata('logged_in_akun')))
        {
            $session_data = $this->session->userdata('logged_in_akun');
            $dataAkun['username'] = $session_data['username'];

            $this->load->view('template/header_akun', $dataAkun);
			$this->load->view('detailKamar', $data);
			$this->load->view('template/footer');
        }
        else {
        	$this->load->view('template/header');
			$this->load->view('detailKamar', $data);
			$this->load->view('template/footer');
        }
	}
}