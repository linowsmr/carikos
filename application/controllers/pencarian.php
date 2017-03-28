<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_pencarian','',TRUE);
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

		$fasilitaskos = implode(",", $kos);
		$fasilitaskamar = implode(",", $kamar);

		$nilaiDestinasi = 0;

		$cluster = $this->model_cluster->ambil_cluster();
		foreach($cluster as $row){
			$idCluster = $row->idCluster;
			if($row->nilaiDestinasiCluster == 0){
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
		$data['hasil'] = $this->model_pencarian->pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);
		$data['bp'] = $this->model_pencarian->bp();
		//var_dump($data['hasil']);
		$this->load->view('template/header');
		$this->load->view('hasil_pencarian', $data);
		$this->load->view('template/footer');
	}
}