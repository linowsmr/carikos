<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cluster extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_cluster','',TRUE);
	   	$this->load->model('model_jurusan','',TRUE);
 	}

 	public function kmeans()
	{
		$id = $this->input->get('kos');

		$data['latlng'] = $this->model_cluster->data_latlng();

		$point = array();
		$dataPoint = array();

		foreach($data['latlng'] as $row){
			$latlong = substr($row->latLngKos, 1, -1);
			$coord = explode(", ", $latlong);

			array_push($point, $coord[0]);
			array_push($point, $coord[1]);
		}

		$totalCoord = sizeof($data['latlng']);

		for($i =0; $i < $totalCoord; $i++){
			for($j =0; $j < 2; $j++){
				$dataPoint[$i][$j] = array_shift($point);
			}
		}
		
		require_once "assets/KMeans/Space.php";
		require_once "assets/KMeans/Point.php";
		require_once "assets/KMeans/Cluster.php";

		$space = new KMeans\Space(2);

		foreach ($dataPoint as $coordinates)
			$space->addPoint($coordinates);

		$clusters = $space->solve(2);

		$this->model_cluster->hapus_cluster();
		$this->model_cluster->hapus_cluster_destinasi();
		$this->model_jurusan->hapus_cluster_jurusan();
		
		foreach ($clusters as $i => $cluster){
			$latLngCluster = "($cluster[0], $cluster[1])";
			$idCluster = $this->model_cluster->cluster($latLngCluster);

			$jurusan = $this->model_jurusan->ambil_semua_jurusan();
			foreach($jurusan as $row){
				$this->model_jurusan->input_cluster_jurusan($idCluster, $row->idJurusan);
			}

			foreach ($cluster as $j => $member){
				$latlng = "($member[0], $member[1])";
				$idKos = $this->model_cluster->pencarian_by_latlng($latlng);
				foreach($idKos as $row){
					$this->model_cluster->update_idcluster($row->idKos, $idCluster);
				}
			}
		}
		$_SESSION['kos'] = $id;
		$_SESSION['destinasi'] = "minimarket";
		redirect('cluster/destinasi');
	}

	public function destinasi()
	{
		if($_SESSION['destinasi'] == "minimarket"){
			$id = $_SESSION['kos'];
		
			$data['detail'] = $this->model_kos->detail_kos($id);

			foreach($data['detail'] as $row){
				$id = $row->idKos;
				$idCluster = $row->idCluster;
			}

			$result = $this->model_cluster->cek_destinasi($idCluster, 1);

			if($result == 0) {
				if($data['detail']){
					$this->load->view('template/header-2');
					$this->load->view('ambil_minimarket', $data);
					$this->load->view('template/footer-2');
				}
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "supermarket";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "supermarket"){
			$id = $_SESSION['kos'];
			$data['detail'] = $this->model_kos->detail_kos($id);

			foreach($data['detail'] as $row){
				$id = $row->idKos;
				$idCluster = $row->idCluster;
			}

			$result = $this->model_cluster->cek_destinasi($idCluster, 2);

			if($result == 0) {
				if($data['detail']){
					$this->load->view('template/header-2');
					$this->load->view('ambil_supermarket', $data);
					$this->load->view('template/footer-2');
				}
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "masjid";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "masjid"){
			$id = $_SESSION['kos'];
			$data['detail'] = $this->model_kos->detail_kos($id);

			foreach($data['detail'] as $row){
				$id = $row->idKos;
				$idCluster = $row->idCluster;
			}

			$result = $this->model_cluster->cek_destinasi($idCluster, 3);

			if($result == 0) {
				if($data['detail']){
					$this->load->view('template/header-2');
					$this->load->view('ambil_masjid', $data);
					$this->load->view('template/footer-2');
				}
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "lain";
				$_SESSION['cluster'] = $idCluster;
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "lain"){
			$id = $_SESSION['kos'];
			$idCluster = $_SESSION['cluster'];

			$clusterLainNum = $this->model_cluster->cek_cluster_num($idCluster);
			
			if($clusterLainNum > 0){
				$clusterLain = $this->model_cluster->cek_cluster($idCluster);

				foreach($clusterLain as $row){
					$idClusterBaru = $row->idCluster;
				}

				$cekMinimarket = $this->model_cluster->cek_destinasi($idClusterBaru, 1);

				if($cekMinimarket == 0){
					unset($_SESSION['cluster']);
					$_SESSION['destinasi'] = "minimarket lain";
					$_SESSION['cluster'] = $idClusterBaru;
					redirect('cluster/destinasi');
				}
				else{
					unset($_SESSION['cluster']);
					$_SESSION['destinasi'] = "banjir";
					redirect('cluster/destinasi');
				}
			}
			else{
				unset($_SESSION['cluster']);
				$_SESSION['destinasi'] = "banjir";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "minimarket lain"){
			$data['idKos'] = $_SESSION['kos'];

			$idCluster = $_SESSION['cluster'];
			$data['detail'] = $this->model_cluster->ambil_cluster_id($idCluster);

			$result = $this->model_cluster->cek_destinasi($idCluster, 1);

			if($result == 0) {
				if($data['detail']){
					$this->load->view('template/header-2');
					$this->load->view('ambil_minimarket_pencarian', $data);
					$this->load->view('template/footer-2');
				}
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "supermarket lain";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "supermarket lain"){
			$data['idKos'] = $_SESSION['kos'];

			$idCluster = $_SESSION['cluster'];
			$data['detail'] = $this->model_cluster->ambil_cluster_id($idCluster);

			$result = $this->model_cluster->cek_destinasi($idCluster, 2);

			if($result == 0) {
				if($data['detail']){
					$this->load->view('template/header-2');
					$this->load->view('ambil_supermarket_pencarian', $data);
					$this->load->view('template/footer-2');
				}
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "masjid lain";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "masjid lain"){
			$data['idKos'] = $_SESSION['kos'];

			$idCluster = $_SESSION['cluster'];
			$data['detail'] = $this->model_cluster->ambil_cluster_id($idCluster);

			$result = $this->model_cluster->cek_destinasi($idCluster, 3);

			if($result == 0) {
				if($data['detail']){
					$this->load->view('template/header-2');
					$this->load->view('ambil_masjid_pencarian', $data);
					$this->load->view('template/footer-2');
				}
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "lain";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "banjir"){
			$data['kos'] = $this->model_kos->detail_kos($_SESSION['kos']);
			$this->load->view('template/header-2');
			$this->load->view('kos_banjir', $data);
			$this->load->view('template/footer-2');
		}

		else if($_SESSION['destinasi'] == "ramai"){
			$data['kos'] = $this->model_kos->detail_kos($_SESSION['kos']);
			$this->load->view('template/header-2');
			$this->load->view('kos_ramai', $data);
			$this->load->view('template/footer-2');
		}
	}

	function cluster_data_minimarket()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "supermarket";
		redirect('cluster/destinasi');
	}

	function cluster_data_supermarket()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "masjid";
		redirect('cluster/destinasi');
	}

	function cluster_data_masjid()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);

		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "lain";
		$_SESSION['cluster'] = $idCluster;
		redirect('cluster/destinasi');
	}

	function cluster_data_minimarket_pencarian()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "supermarket lain";
		redirect('cluster/destinasi');
	}

	function cluster_data_supermarket_pencarian()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "masjid lain";
		redirect('cluster/destinasi');
	}

	function cluster_data_masjid_pencarian()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "lain";
		redirect('cluster/destinasi');
	}

	function kos_banjir()
	{
		$idKos = $this->input->post('kos');
		$nilaiBanjir = $this->input->post('nilai')*0.05;

		$this->model_kos->nilai_banjir($idKos, $nilaiBanjir);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "ramai";
		redirect('cluster/destinasi');
	}

	function kos_ramai()
	{
		$idKos = $this->input->post('kos');
		$nilaiRamai = $this->input->post('nilai')*0.03;

		$this->model_kos->nilai_ramai($idKos, $nilaiRamai);
		unset($_SESSION['destinasi']);
		redirect('jurusan/jarak');
	}
}
