<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_cluster','',TRUE);
	   	$this->load->model('model_jurusan','',TRUE);
 	}

	public function jarak()
	{
		//$idCluster = array();
		$cluster = $this->model_cluster->ambil_cluster();
		foreach($cluster as $row){
			//array_push($idCluster, $row->idCluster);
			$jurusan = $this->model_jurusan->ambil_semua_jurusan();
			foreach ($jurusan as $row2) {
				$cekNilai = $this->model_jurusan->cek_nilai($row->idCluster, $row2->idJurusan);
				//echo $cekNilai;
				if($cekNilai == 1){
					//echo "$row->idCluster dan $row2->idJurusan <br>";
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
		//exit();
		//echo "$idCluster dan $idJurusan";
		
		//var_dump($data);
		if(isset($data)){
			$this->load->view('template/header-2');
			$this->load->view('jarak_jurusan', $data);
			$this->load->view('template/footer-2');	
		}
		else{
			$id = $_SESSION['kos'];
			unset($_SESSION['kos']);
			redirect('kos/beranda?kos='.$id.'');
			//echo "Selesai!";
		}
		
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

		// echo "$idCluster dan $idJurusan, $jarakClusterJurusan, $nilaiDestinasi";
		// exit();

		$this->model_jurusan->jarak_cluster_jurusan($idCluster, $idJurusan, $jarakClusterJurusan, $nilaiDestinasi);

		redirect('jurusan/jarak');

	}
}
