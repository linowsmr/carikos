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
 	}

	public function index()
	{
		$kota = $this->input->get('kota');
		
		$harga = $this->input->get('harga');
		if($harga == 1){
			$minHarga = 0;
			$maxHarga = 500000;
		}
		else if($harga == 2){
			$minHarga = 500001;
			$maxHarga = 1000000;
		}
		else if($harga == 3){
			$minHarga = 1000001;
			$maxHarga = 1500000;
		}
		else if($harga == 4){
			$minHarga = 1500001;
			$maxHarga = 9999999;
		}

		$tipe = $this->input->get('tipe');
		$kos = $this->input->get('fasilitaskos');
		$kamar = $this->input->get('fasilitaskamar');
		// $jurusan = $this->input->get('jurusan');

		// if($jurusan != "")
		// 	$data['jurusan'] = $this->model_pencarian->ambil_jurusan($jurusan);

		$fasilitaskos = implode(",", $kos);
		$fasilitaskamar = implode(",", $kamar);

		$nilaiDestinasi = 0;

		$hasilPencarian = $this->model_pencarian->pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);

		$cluster = $this->model_cluster->ambil_cluster();
		foreach($hasilPencarian as $row){
			$idCluster = $row->idCluster;
			if($row->nilaiDestinasiCluster == 0 || $row->nilaiDestinasiCluster == ""){

				$cekMinimarket = $this->model_cluster->cek_destinasi($idCluster, 1);
				if($cekMinimarket == 0){
					//redirect('')
				}

				$jarakMinimarket = $this->model_cluster->jarak_destinasi($idCluster, 1);
				$jarakSupermarket = $this->model_cluster->jarak_destinasi($idCluster, 2);

				if($jarakMinimarket < $jarakSupermarket){
					$jarakMarket = $jarakMinimarket;
				} else if ($jarakMinimarket > $jarakSupermarket) {
					$jarakMarket = $jarakSupermarket;
				} else if ($jarakMinimarket == $jarakSupermarket){
					$jarakMarket = $jarakMinimarket;
				}

				//var_dump($jarakMarket);
				foreach($jarakMarket as $row){
					$jarakFinalMarket = $row->jarakDestinasi;
					$bobotMarket = 0.22;

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
					
					//echo "ID Cluster = $idCluster, Nilai Sementara = $nilaiDestinasi <br>";
				}

				$jarakMasjid = $this->model_cluster->jarak_destinasi($idCluster, 3);

				foreach($jarakMasjid as $row){
					$jarakFinalMasjid = $row->jarakDestinasi;
					$bobotTempatIbadah = 0.02;

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
					
					//echo "ID Cluster = $idCluster, Nilai Sementara = $nilaiDestinasi <br>";
				}
				$this->model_cluster->nilai_destinasi($idCluster, $nilaiDestinasi);
			}
			$nilaiDestinasi = 0;
		}

		//exit();
		
		$data['bp'] = $this->model_pencarian->bp();

		foreach($hasilPencarian as $row){
			$idKos = $row->idKos;
			$idKamar = $row->idKamar;
			$nilaiParkiranPenjagaKos = $row->nilaiParkiranPenjagaKos;
			$nilaiFasilitas = $row->nilaiFasilitasKamar;

			if($nilaiParkiranPenjagaKos == 0 || $nilaiParkiranPenjagaKos == ""){
				$luasParkiran = $this->model_cluster->luas_parkiran($idKos);
				$bobotLuasParkiran = 0.1;
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
				$bobotPenjagaKos = 0.07;
				if($penjagaKos == 1)
					$nilaiPenjagaKos = 100*$bobotPenjagaKos;
				else
					$nilaiPenjagaKos = 0*$bobotPenjagaKos;

				$nilaiParkiranPenjaga = $nilaiLuasParkir + $nilaiPenjagaKos;
				$this->model_cluster->update_nilai_kos($idKos, $nilaiParkiranPenjaga);
			}
			
			if($nilaiFasilitas == 0 || $nilaiFasilitas == ""){
				$fasilitas = $this->model_cluster->fasilitas_lengkap($idKamar);
				$bobotFasilitasKamar = 0.34;
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
			
			//echo "Nilai Parkiran dan Penjaga = $nilaiParkiranPenjaga dan Nilai Fasilitas Kamar = $nilaiFasilitasKamar <br>";
		}


		//exit();
		$data['hasil'] = $this->model_pencarian->pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);

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
		$data['harga'] = $this->input->post('hargaKamar');
		$data['detailKos'] =  $this->model_kos->detail_kos($idKos);
		foreach($data['detailKos'] as $row){
			$idCluster = $row->idCluster;
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