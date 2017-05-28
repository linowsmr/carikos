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

		$clusters = $space->solve(3);

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
		$_SESSION['destinasi'] = "cek";
		redirect('cluster/destinasi');
	}

	public function destinasi()
	{
		if($_SESSION['destinasi'] == "minimarket"){

			$idCluster = $_SESSION['cluster'];

			$result = $this->model_cluster->cek_destinasi($idCluster, 1);
			$data['cluster'] = $this->model_cluster->ambil_cluster_id($idCluster);

			if($result == 0) {
				$this->load->view('template/header-2');
				$this->load->view('ambil_minimarket', $data);
				$this->load->view('template/footer-2');
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "supermarket";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "supermarket"){
			$idCluster = $_SESSION['cluster'];

			$result = $this->model_cluster->cek_destinasi($idCluster, 2);
			$data['cluster'] = $this->model_cluster->ambil_cluster_id($idCluster);

			if($result == 0) {
				$this->load->view('template/header-2');
				$this->load->view('ambil_supermarket', $data);
				$this->load->view('template/footer-2');
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "masjid";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "masjid"){
			$idCluster = $_SESSION['cluster'];

			$result = $this->model_cluster->cek_destinasi($idCluster, 3);
			$data['cluster'] = $this->model_cluster->ambil_cluster_id($idCluster);

			if($result == 0) {
				$this->load->view('template/header-2');
				$this->load->view('ambil_masjid', $data);
				$this->load->view('template/footer-2');
			}
			else {
				unset($_SESSION['destinasi']);
				$_SESSION['destinasi'] = "cek";
				redirect('cluster/destinasi');
			}
		}

		else if($_SESSION['destinasi'] == "cek"){
			unset($_SESSION['cluster']);
			$id = $_SESSION['kos'];

			$clusterLainNum = $this->model_cluster->cek_cluster_num();

			if($clusterLainNum > 0){
				$clusterLain = $this->model_cluster->cek_cluster();

				foreach($clusterLain as $row){
					$idCluster = $row->idCluster;
				}

				$_SESSION['cluster'] = $idCluster;
				$cekMinimarket = $this->model_cluster->cek_destinasi($idCluster, 1);

				if($cekMinimarket == 0){
					$_SESSION['destinasi'] = "minimarket";
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

		else if($_SESSION['destinasi'] == "jurusan"){
			$cluster = $this->model_cluster->ambil_cluster();
			foreach($cluster as $row){
				$jurusan = $this->model_jurusan->ambil_semua_jurusan();
				foreach ($jurusan as $row2) {
					$cekNilai = $this->model_jurusan->cek_nilai($row->idCluster, $row2->idJurusan);
					if($cekNilai == 1){
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
				$id = $_SESSION['kos'];
				unset($_SESSION['kos']);
				redirect('kos/beranda?kos='.$id.'');
			}
		}
	}

	function cluster_data_minimarket()
	{
		$idCluster = $_SESSION['cluster'];
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "supermarket";
		redirect('cluster/destinasi');
	}

	function cluster_data_supermarket()
	{
		$idCluster = $_SESSION['cluster'];
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "masjid";
		redirect('cluster/destinasi');
	}

	function cluster_data_masjid()
	{
		$idCluster = $_SESSION['cluster'];
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);

		$status = $this->model_cluster->status_cluster($idCluster, 1);

		unset($_SESSION['destinasi']);
		$_SESSION['destinasi'] = "cek";
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
		$_SESSION['destinasi'] = "jurusan";
		redirect('cluster/destinasi');
	}

	public function data_jarak()
	{
		$idCluster = $this->input->post('cluster');
		$idJurusan = $this->input->post('jurusan');
		$jarakClusterJurusan = $this->input->post('jarak');

		$nilaiDestinasi = 0;
		$bobotJurusan = 0.16;
		if($jarakClusterJurusan <= 2)
			$nilaiDestinasi = $nilaiDestinasi + 100*$bobotJurusan;
		else if($jarakClusterJurusan > 2 && $jarakClusterJurusan <=3)
			$nilaiDestinasi = $nilaiDestinasi + 75*$bobotJurusan;
		else if($jarakClusterJurusan > 3 && $jarakClusterJurusan <=4)
			$nilaiDestinasi = $nilaiDestinasi + 50*$bobotJurusan;
		else if($jarakClusterJurusan > 4 && $jarakClusterJurusan <=5)
			$nilaiDestinasi = $nilaiDestinasi + 25*$bobotJurusan;
		else if($jarakClusterJurusan > 5)
			$nilaiDestinasi = $nilaiDestinasi + 0*$bobotJurusan;

		$this->model_jurusan->jarak_cluster_jurusan($idCluster, $idJurusan, $jarakClusterJurusan, $nilaiDestinasi);

		redirect('cluster/destinasi');

	}
}
