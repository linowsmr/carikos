<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_pemesanan','',TRUE);
 	}

	public function daftar()
	{
		$jenis = $this->input->post('jenis');
		$harga = $this->input->post('harga');
		$jumlah = $this->input->post('jumlah');
		$fasilitas = $this->input->post('fasilitas');
		$panjang = $this->input->post('panjang');
		$lebar = $this->input->post('lebar');
		$kali = " X ";
		$luas = $panjang.$kali.$lebar;
		$idKos = $this->input->post('id');

		$insert = $this->model_kamar->insert($jenis, $harga, $jumlah, $luas, $idKos);

		if($insert != "Gagal"){
	        for($a=0; $a<sizeof($fasilitas); $a++){
	            $this->model_kamar->insert_fasilitas($insert, $fasilitas[$a]);
	        }

	        $extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
	        if(isset($_FILES['foto'])){
	        	$name_array = $_FILES['foto']['name'];
	        	$tmp_name_array = $_FILES['foto']['tmp_name'];
	        	
    	 		for($i=0; $i < count($tmp_name_array); $i++){
    				$ext=pathinfo($name_array[$i],PATHINFO_EXTENSION);
    				$hash = "-";
    				$name_file = $idKos.$hash.$insert.$hash.$name_array[$i];
    				if(in_array($ext,$extension)){
    					if(!file_exists("assets/images/kamar/".$name_file)){
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kamar/".$name_file);
    						$this->model_kamar->insert_foto($insert, $name_file);
    					}
    					else {
    						$filename = basename($name_file, $ext);
    						$newFileName=$filename.time().".".$ext;
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kamar/".$newFileName);
    						$this->model_kamar->insert_foto($insert, $newFileName);
    					}
    				}
    				else
    					echo "Salah Ekstensi";
    			}
	        }

	        redirect('kamar/beranda?kamar='.$insert.'');
		}
		else {
			echo "Gagal Input";
		}
	}

	public function update()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $dataPemilik['username'] = $session_data['username'];
            $dataPemilik['notifikasi'] = $this->model_pemesanan->count_pemesanan($dataPemilik['username']);
            
            $id = $this->input->get('kamar');

            $data['detail'] = $this->model_kamar->detail_kamar($id);

            if($data['detail']){
            	foreach($data['detail'] as $row){
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($dataPemilik['username'] == $pemilik){
	            	$this->load->view('template/header_pemilik', $dataPemilik);
					$this->load->view('ubah_kamar', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kamar Anda";
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
		$jenis = $this->input->post('jenis');
		$harga = $this->input->post('harga');
		$jumlah = $this->input->post('jumlah');
		$panjang = $this->input->post('panjang');
		$lebar = $this->input->post('lebar');
		$kali = " X ";
		$luas = $panjang.$kali.$lebar;
		$id = $this->input->post('id');

		$update = $this->model_kamar->update($id, $jenis, $harga, $jumlah, $luas);

		if($update == "Berhasil"){
	        redirect('kamar/beranda?kamar='.$id.'');
		}
		else {
			echo "Gagal Input";
		}
	}

	public function delete()
	{
		$kos = $this->input->post('kos');
		$id = $this->input->post('kamar');
		$this->model_kamar->delete_fasilitas_kamar($id);

		$data['foto'] = $this->model_kamar->list_foto($id);
		foreach($data['foto'] as $row){
			unlink("assets/images/kamar/".$row->namaFileKamar);
		}
		

		$this->model_kamar->delete_foto_kamar($id);
		$this->model_kamar->delete($id);

		redirect('kos/beranda?kos='.$kos.'');
	}

	public function beranda()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $dataPemilik['username'] = $session_data['username'];
            $dataPemilik['notifikasi'] = $this->model_pemesanan->count_pemesanan($dataPemilik['username']);
            
            $id = $this->input->get('kamar');
            $data['id'] = $id;

            $data['detail'] = $this->model_kamar->detail_kamar($id);

            if($data['detail']){
            	$data['fasilitas'] = $this->model_kamar->fasilitas_kamar($id);
            	$data['foto'] = $this->model_kamar->list_foto($id);

	            foreach($data['detail'] as $row){
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($dataPemilik['username'] == $pemilik){
	            	$this->load->view('template/header_pemilik', $dataPemilik);
					$this->load->view('beranda_kamar', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kamar Anda";
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

	public function tambah_fasilitas()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $dataPemilik['username'] = $session_data['username'];
            $dataPemilik['notifikasi'] = $this->model_pemesanan->count_pemesanan($dataPemilik['username']);
            
            $id = $this->input->get('kamar');
            $data['id'] = $id;

            $data['detail'] = $this->model_kamar->detail_kamar($id);
            $data['fasilitas'] = $this->model_kamar->fasilitas_kamar_non($id);

            if($data['detail']){
            	$data['fasilitas_kamar'] = $this->model_kamar->fasilitas_kamar($id);

	            foreach($data['detail'] as $row){
	            	$data['jenis'] = $row->jenisKamar;
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($dataPemilik['username'] == $pemilik){
	            	$this->load->view('template/header_pemilik', $dataPemilik);
					$this->load->view('tambah_fasilitas_kamar', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kamar Anda";
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
            $this->model_kamar->insert_fasilitas($id, $fasilitas[$a]);
        }

        redirect('kamar/beranda?kamar='.$id.'');
	}

	public function delete_fasilitas()
	{
		$kamar = $this->input->post('kamar');
		$id = $this->input->post('fasilitas');
		$this->model_kamar->hapus_fasilitas($id);

		redirect('kamar/beranda?kamar='.$kamar.'');
	}

	public function tambah_foto()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $dataPemilik['username'] = $session_data['username'];
            $dataPemilik['notifikasi'] = $this->model_pemesanan->count_pemesanan($dataPemilik['username']);
            
            $id = $this->input->get('kamar');
            $data['id'] = $id;

            $data['detail'] = $this->model_kamar->detail_kamar($id);

            if($data['detail']){

	            foreach($data['detail'] as $row){
	            	$data['jenis'] = $row->jenisKamar;
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($dataPemilik['username'] == $pemilik){
	            	$this->load->view('template/header_pemilik', $dataPemilik);
					$this->load->view('tambah_foto_kamar', $data);
					$this->load->view('template/footer');
	            }
	            else {
	            	echo "Bukan Kamar Anda";
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
    					if(!file_exists("assets/images/kamar/".$name_file)){
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kamar/".$name_file);
    						$this->model_kamar->insert_foto($id, $name_file);
    					}
    					else {
    						$filename = basename($name_file, $ext);
    						$newFileName=$filename.time().".".$ext;
    						move_uploaded_file($tmp_name_array[$i], "assets/images/kamar/".$newFileName);
    						$this->model_kamar->insert_foto($id, $newFileName);
    					}
    				}
    				else
    					echo "Salah Ekstensi";
    			}
	        }
	    redirect('kamar/beranda?kamar='.$id.'');    
	}

	public function hapus_foto()
	{
		$kamar = $this->input->post('kamar');
		$id = $this->input->post('foto');
		$nama_file = $this->input->post('nama');
		$this->model_kamar->hapus_foto($id);
		unlink("assets/images/kamar/".$nama_file);

		redirect('kamar/beranda?kamar='.$kamar.'');
	}

}
