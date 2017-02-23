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

	}

	public function delete()
	{
		$id = $this->input->get('kos');
		$this->model_kos->delete($id);

		redirect('pemilik/beranda');
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
		$kos = $this->input->get('kos');
		$id = $this->input->get('tipe');
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
		$kos = $this->input->get('kos');
		$id = $this->input->get('fasilitas');
		$this->model_kos->hapus_fasilitas($id);

		redirect('kos/beranda?kos='.$kos.'');
	}
}
