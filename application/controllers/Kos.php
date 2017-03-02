<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kos extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
 	}

	public function daftar()
	{
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$telepon = $this->input->post('telepon');
		$tipe = $this->input->post('tipe');
		$fasilitas = $this->input->post('fasilitas');
		$pemilik = $this->input->post('pemilik');

		$insert = $this->model_kos->insert($nama, $alamat, $telepon, $pemilik);

		if($insert != "Gagal"){
			for($a=0; $a<sizeof($tipe); $a++){
	            $this->model_kos->insert_tipe($insert, $tipe[$a]);
	        }

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

	        redirect('kos/beranda?kos='.$insert.'');
		}
		else {
			echo "Gagal Input";
		}
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

		$update = $this->model_kos->update($id, $nama, $alamat, $telepon);
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

	public function tambah_tipe()
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

	public function tambah_tipe_baru()
	{
		$tipe = $this->input->post('tipe');
		$id = $this->input->post('id');

		for($a=0; $a<sizeof($tipe); $a++){
            $this->model_kos->insert_tipe($id, $tipe[$a]);
        }

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
