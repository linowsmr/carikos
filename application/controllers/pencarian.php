<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_pencarian','',TRUE);
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
		else if($harga == 2){
			$minHarga = 1000001;
			$maxHarga = 1500000;
		}
		else if($harga == 2){
			$minHarga = 1500001;
			$maxHarga = 9999999;
		}

		$tipe = $this->input->get('tipe');
		$kos = $this->input->get('fasilitaskos');
		$kamar = $this->input->get('fasilitaskamar');

		$fasilitaskos = implode(",", $kos);
		$fasilitaskamar = implode(",", $kamar);

		$data['hasil'] = $this->model_pencarian->pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar);

		$point = array();
		$dataPoint = array();

		foreach($data['hasil'] as $row){
			$latlong = substr($row->latLngKos, 1, -1);
			$coord = explode(", ", $latlong);

			array_push($point, $coord[0]);
			array_push($point, $coord[1]);
		}

		$totalCoord = sizeof($data['hasil']);

		for($i =0; $i < $totalCoord; $i++){
			for($j =0; $j < 2; $j++){
				$dataPoint[$i][$j] = array_shift($point);
			}
		}

		// $dataPoint[0][0] = $point[0];
		// $dataPoint[0][1] = $point[1];
		// $dataPoint[1][0] = $point[2];
		// $dataPoint[1][1] = $point[3];
		
		require_once "assets/KMeans/Space.php";
		require_once "assets/KMeans/Point.php";
		require_once "assets/KMeans/Cluster.php";

		// create a 2-dimentions space
		$space = new KMeans\Space(2);

		// add points to space
		foreach ($dataPoint as $coordinates)
			$space->addPoint($coordinates);

		// cluster these 50 points in 3 clusters
		$clusters = $space->solve(2);

		//var_dump($clusters);

		// display the cluster centers and attached points
		foreach ($clusters as $i => $cluster){
			printf("----- Cluster %s (%f,%f): %d points -----", $i, $cluster[0], $cluster[1], count($cluster));
			
			foreach ($cluster as $j => $member){
				$latlng = "($member[0], $member[1])";
				$idKos = $this->model_pencarian->pencarian_by_latlng($latlng);
				foreach($idKos as $row){
					printf("$row->idKos");
				}
				//printf("$idKos");
			}
		}
		
	}
	
}
