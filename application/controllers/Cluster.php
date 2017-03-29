<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cluster extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_cluster','',TRUE);
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

		$this->model_cluster->hapus_cluster();
		$this->model_cluster->hapus_cluster_destinasi();
		
		// display the cluster centers and attached points
		foreach ($clusters as $i => $cluster){
			//printf("Cluster %s (%f,%f): %d points <br>", $i, $cluster[0], $cluster[1], count($cluster));
			$latLngCluster = "($cluster[0], $cluster[1])";
			$idCluster = $this->model_cluster->cluster($latLngCluster);

			foreach ($cluster as $j => $member){
				$latlng = "($member[0], $member[1])";
				$idKos = $this->model_cluster->pencarian_by_latlng($latlng);
				foreach($idKos as $row){
					$this->model_cluster->update_idcluster($row->idKos, $idCluster);
					//echo "- $row->idKos <br>";
				}
			}
		}

		redirect('cluster/cluster_minimarket?kos='.$id.'');
	}

	public function cluster_minimarket()
	{
		$id = $this->input->get('kos');
		$data['detail'] = $this->model_kos->detail_kos($id);

		foreach($data['detail'] as $row){
			$id = $row->idKos;
			$idCluster = $row->idCluster;
		}

		$result = $this->model_cluster->cek_destinasi($idCluster, 1);

		if($result == 0) {
			if($data['detail']){
				$this->load->view('template/header');
				$this->load->view('ambil_minimarket', $data);
				$this->load->view('template/footer');
			}
		}
		else {
			redirect('cluster/cluster_supermarket?kos='.$id.'');
		}
	}

	function cluster_data_minimarket()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		//$this->load->view('berhasil');
		redirect('cluster/cluster_supermarket?kos='.$id.'');
	}

	public function cluster_supermarket()
	{
		//echo "Masuk ke Supermarket";
		
		$id = $this->input->get('kos');
		$data['detail'] = $this->model_kos->detail_kos($id);

		foreach($data['detail'] as $row){
			$id = $row->idKos;
			$idCluster = $row->idCluster;
		}

		$result = $this->model_cluster->cek_destinasi($idCluster, 2);

		if($result == 0) {
			if($data['detail']){
				$this->load->view('template/header');
				$this->load->view('ambil_supermarket', $data);
				$this->load->view('template/footer');
			}
		}
		else {
			redirect('cluster/cluster_masjid?kos='.$id.'');
		}
	}

	function cluster_data_supermarket()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		redirect('cluster/cluster_masjid?kos='.$id.'');
	}

	public function cluster_masjid()
	{
		$id = $this->input->get('kos');
		$data['detail'] = $this->model_kos->detail_kos($id);

		foreach($data['detail'] as $row){
			$id = $row->idKos;
			$idCluster = $row->idCluster;
		}

		$result = $this->model_cluster->cek_destinasi($idCluster, 3);

		if($result == 0) {
			if($data['detail']){
				$this->load->view('template/header');
				$this->load->view('ambil_masjid', $data);
				$this->load->view('template/footer');
			}
		}
		else {
			redirect('kos/beranda?kos='.$id.'');
		}
	}

	function cluster_data_masjid()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);

		redirect('cluster/cek_cluster_lain?cluster='.$idCluster.'&kos='.$id.'');
	}

	public function cek_cluster_lain()
	{
		$id = $this->input->get('kos');
		$idCluster = $this->input->get('cluster');

		$clusterLainNum = $this->model_cluster->cek_cluster_num($idCluster);
		
		if($clusterLainNum > 0){
			$clusterLain = $this->model_cluster->cek_cluster($idCluster);

			foreach($clusterLain as $row){
				$idClusterBaru = $row->idCluster;
			}

			$cekMinimarket = $this->model_cluster->cek_destinasi($idClusterBaru, 1);

			if($cekMinimarket == 0){
				redirect('cluster/cluster_minimarket_pencarian?cluster='.$idClusterBaru.'&kos='.$id.'');
			}
			else
				redirect('kos/beranda?kos='.$id.'');
		}
		else
			redirect('kos/beranda?kos='.$id.'');
	}

	public function cluster_minimarket_pencarian()
	{
		$data['idKos'] = $this->input->get('kos');

		$idCluster = $this->input->get('cluster');
		$data['detail'] = $this->model_cluster->ambil_cluster_id($idCluster);

		$result = $this->model_cluster->cek_destinasi($idCluster, 1);

		if($result == 0) {
			if($data['detail']){
				$this->load->view('template/header');
				$this->load->view('ambil_minimarket_pencarian', $data);
				$this->load->view('template/footer');
			}
		}
		else {
			redirect('cluster/cluster_supermarket_pencarian?cluster='.$idCluster.'&kos='.$data['idKos'].'');
		}
	}

	function cluster_data_minimarket_pencarian()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		//$this->load->view('berhasil');
		redirect('cluster/cluster_supermarket_pencarian?cluster='.$idCluster.'&kos='.$id.'');
	}

	public function cluster_supermarket_pencarian()
	{
		//echo "Masuk ke Supermarket";
		$data['idKos'] = $this->input->get('kos');
		$idCluster = $this->input->get('cluster');
		$data['detail'] = $this->model_cluster->ambil_cluster_id($idCluster);

		$result = $this->model_cluster->cek_destinasi($idCluster, 2);

		if($result == 0) {
			if($data['detail']){
				$this->load->view('template/header');
				$this->load->view('ambil_supermarket_pencarian', $data);
				$this->load->view('template/footer');
			}
		}
		else {
			redirect('cluster/cluster_masjid_pencarian?cluster='.$idCluster.'&kos='.$data['idKos'].'');
		}
	}

	function cluster_data_supermarket_pencarian()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		//$this->load->view('berhasil');
		redirect('cluster/cluster_masjid_pencarian?cluster='.$idCluster.'&kos='.$id.'');
	}

	public function cluster_masjid_pencarian()
	{
		$data['idKos'] = $this->input->get('kos');
		$idCluster = $this->input->get('cluster');
		$data['detail'] = $this->model_cluster->ambil_cluster_id($idCluster);

		$result = $this->model_cluster->cek_destinasi($idCluster, 3);

		if($result == 0) {
			if($data['detail']){
				$this->load->view('template/header');
				$this->load->view('ambil_masjid_pencarian', $data);
				$this->load->view('template/footer');
			}
		}
		else {
			//echo "Masuk ke Kos";
			redirect('cluster/cek_cluster_lain?kos='.$data['idKos'].'');
		}
	}

	function cluster_data_masjid_pencarian()
	{
		$id = $this->input->post('kos');
		$idCluster = $this->input->post('cluster');
		$idDestination = $this->input->post('destination');
		$distance = $this->input->post('distance');

		$this->model_cluster->destinasi($idCluster, $idDestination, $distance);
		//$this->load->view('berhasil');
		redirect('cluster/cek_cluster_lain?cluster='.$idCluster.'&kos='.$id.'');
	}

}
