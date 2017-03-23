<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kos extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_pencarian','',TRUE);
 	}

	public function daftar()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$latlng = $this->input->post('latlng');
		$telepon = $this->input->post('telepon');
		$parkiran = $this->input->post('parkiran');
		$tipe = $this->input->post('tipe');
		$fasilitas = $this->input->post('fasilitas');
		$pemilik = $this->input->post('pemilik');

		$insert = $this->model_kos->insert($nama, $alamat, $latlng, $telepon, $tipe, $parkiran, $pemilik);

		if($insert != "Gagal"){
	        for($b=0; $b<sizeof($fasilitas); $b++){
	            $this->model_kos->insert_fasilitas($insert, $fasilitas[$b]);
	        }

	        $extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
	        if(isset($_FILES['foto'])){
	        	$name_array = $_FILES['foto']['name'];
	        	$tmp_name_array = $_FILES['foto']['tmp_name'];
	        	
    	 		for($i=0; $i < count($tmp_name_array); $i++){
    				$ext=pathinfo($name_array[$i],PATHINFO_EXTENSION);
    				$hash = "-";
    				$name_file = $insert.$hash.$name_array[$i];
    				if(in_array($ext,$extension)){
    					if(!file_exists("assets/images/kos/".$name_file)){
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kos/".$name_file);
    						$this->model_kos->insert_foto($insert, $name_file);
    					}
    					else {
    						$filename = basename($name_file, $ext);
    						$newFileName=$filename.time().".".$ext;
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kos/".$newFileName);
    						$this->model_kos->insert_foto($insert, $newFileName);
    					}
    				}
    				else
    					echo "Salah Ekstensi";
    			}
	        }

	        redirect('kos/kmeans?kos='.$insert.'');
		}
		else {
			echo "Gagal Input";
		}
	}

	public function kmeans()
	{
		$id = $this->input->get('kos');

		$data['latlng'] = $this->model_pencarian->data_latlng();

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

		// display the cluster centers and attached points
		foreach ($clusters as $i => $cluster){
			printf("Cluster %s (%f,%f): %d points <br>", $i, $cluster[0], $cluster[1], count($cluster));
			$latLngCluster = "($cluster[0], $cluster[1])";
			$idCluster = $this->model_pencarian->cluster($latLngCluster);

			foreach ($cluster as $j => $member){
				$latlng = "($member[0], $member[1])";
				$idKos = $this->model_pencarian->pencarian_by_latlng($latlng);
				foreach($idKos as $row){
					$this->model_pencarian->update_idcluster($row->idKos, $idCluster);
					echo "- $row->idKos <br>";
				}
			}
		}

		redirect('kos/beranda?kos='.$id.'');
	}

	public function beranda()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->get('kos');
            $data['id'] = $id;

            $data['detail'] = $this->model_kos->detail_kos($id);

            if($data['detail']){
            	$data['fasilitas'] = $this->model_kos->fasilitas_kos($id);
	            $data['tipe'] = $this->model_kos->tipe_kos($id);
	            $data['foto'] = $this->model_kos->list_foto($id);
	            $data['jumlah'] = $this->model_kamar->count_list($id);
	            $data['kamar'] = $this->model_kamar->list_kamar($id);
	            $data['fasilitaskamar'] = $this->model_kamar->fasilitas();

	            foreach($data['detail'] as $row){
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->load->view('template/header');
					$this->load->view('beranda_kos', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kos Anda";
	            }
            }
            else {
            	echo "Data Tidak Ditemukan";
            }
            
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function update()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->get('kos');

            $data['detail'] = $this->model_kos->detail_kos($id);
            $data['parkir'] = $this->model_kos->parkiran();

            if($data['detail']){
	            foreach($data['detail'] as $row){
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->load->view('template/header');
					$this->load->view('ubah_kos', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kos Anda";
	            }
            }
            else {
            	echo "Data Tidak Ditemukan";
            }
            
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function update_data()
	{
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telepon = $this->input->post('telepon');
		$parkiran = $this->input->post('parkiran');

		$update = $this->model_kos->update($id, $nama, $alamat, $telepon, $parkiran);
		if($update == 'Berhasil'){
			redirect('kos/beranda?kos='.$id.'');
		}
		else{
			echo "Gagal Update Data";
		}
	}

	public function delete()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->post('kos');

            $data['detail'] = $this->model_kos->detail_kos($id);

            if($data['detail']){
	            foreach($data['detail'] as $row){
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->model_kos->delete_fasilitas_kos($id);
	            	$this->model_kos->delete_tipe_kos($id);

	            	$data['foto'] = $this->model_kos->list_foto($id);
	            	foreach($data['foto'] as $row){
	            		unlink("assets/images/kos/".$row->namaFile);
	            	}
	            	$this->model_kos->delete_foto_kos($id);
					$this->model_kos->delete($id);

					redirect('pemilik/beranda');
	            }
	            else {
	            	echo "Bukan Kos Anda";
	            }
            }
            else {
            	echo "Data Tidak Ditemukan";
            }
            
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function ubah_tipe()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->get('kos');
            $data['id'] = $id;

            $data['detail'] = $this->model_kos->detail_kos($id);
            $data['tipe'] = $this->model_kos->tipe_kos_non($id);

            if($data['detail']){
	            $data['tipe_kos'] = $this->model_kos->tipe_kos($id);

	            foreach($data['detail'] as $row){
	            	$data['nama'] = $row->namaKos;
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->load->view('template/header');
					$this->load->view('tambah_tipe_kos', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kos Anda";
	            }
            }
            else {
            	echo "Data Tidak Ditemukan";
            }
            
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function ubah_tipe_baru()
	{
		$tipe = $this->input->post('tipe');
		$id = $this->input->post('id');

        $this->model_kos->update_tipe($id, $tipe);
        redirect('kos/beranda?kos='.$id.'');
	}

	public function delete_tipe()
	{
		$kos = $this->input->post('kos');
		$id = $this->input->post('tipe');
		$this->model_kos->hapus_tipe($id);

		redirect('kos/beranda?kos='.$kos.'');
	}

	public function tambah_fasilitas()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->get('kos');
            $data['id'] = $id;

            $data['detail'] = $this->model_kos->detail_kos($id);
            $data['fasilitas'] = $this->model_kos->fasilitas_kos_non($id);

            if($data['detail']){
            	$data['fasilitas_kos'] = $this->model_kos->fasilitas_kos($id);

	            foreach($data['detail'] as $row){
	            	$data['nama'] = $row->namaKos;
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->load->view('template/header');
					$this->load->view('tambah_fasilitas_kos', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kos Anda";
	            }
            }
            else {
            	echo "Data Tidak Ditemukan";
            }
            
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function tambah_fasilitas_baru()
	{
		$fasilitas = $this->input->post('fasilitas');
		$id = $this->input->post('id');

		for($a=0; $a<sizeof($fasilitas); $a++){
            $this->model_kos->insert_fasilitas($id, $fasilitas[$a]);
        }

        redirect('kos/beranda?kos='.$id.'');
	}

	public function delete_fasilitas()
	{
		$kos = $this->input->post('kos');
		$id = $this->input->post('fasilitas');
		$this->model_kos->hapus_fasilitas($id);

		redirect('kos/beranda?kos='.$kos.'');
	}

	public function tambah_foto()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->get('kos');
            $data['id'] = $id;

            $data['detail'] = $this->model_kos->detail_kos($id);

            if($data['detail']){

	            foreach($data['detail'] as $row){
	            	$data['nama'] = $row->namaKos;
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->load->view('template/header');
					$this->load->view('tambah_foto_kos', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kos Anda";
	            }
            }
            else {
            	echo "Data Tidak Ditemukan";
            }
            
        }
        else {
            redirect('pemilik/masuk');
        }
	}

	public function tambah_foto_baru()
	{
		$id = $this->input->post('id');
		$extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
	        if(isset($_FILES['foto'])){
	        	$name_array = $_FILES['foto']['name'];
	        	$tmp_name_array = $_FILES['foto']['tmp_name'];
	        	
    	 		for($i=0; $i < count($tmp_name_array); $i++){
    				$ext=pathinfo($name_array[$i],PATHINFO_EXTENSION);
    				$hash = "-";
    				$name_file = $id.$hash.$name_array[$i];
    				if(in_array($ext,$extension)){
    					if(!file_exists("assets/images/kos/".$name_file)){
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kos/".$name_file);
    						$this->model_kos->insert_foto($id, $name_file);
    					}
    					else {
    						$filename = basename($name_file, $ext);
    						$newFileName=$filename.time().".".$ext;
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kos/".$newFileName);
    						$this->model_kos->insert_foto($id, $newFileName);
    					}
    				}
    				else
    					echo "Salah Ekstensi";
    			}
	        }
	    redirect('kos/beranda?kos='.$id.'');    
	}

	public function hapus_foto()
	{
		$kos = $this->input->post('kos');
		$id = $this->input->post('foto');
		$nama_file = $this->input->post('nama');
		$this->model_kos->hapus_foto($id);
		unlink("assets/images/kos/".$nama_file);

		redirect('kos/beranda?kos='.$kos.'');
	}
}
