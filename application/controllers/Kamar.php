<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends CI_Controller {

	function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_kamar','',TRUE);
 	}

	public function daftar()
	{
		$jenis = $this->input->post('jenis');
		$harga = $this->input->post('harga');
		$jumlah = $this->input->post('jumlah');
		$fasilitas = $this->input->post('fasilitas');
		$idKos = $this->input->post('id');

		$insert = $this->model_kamar->insert($jenis, $harga, $jumlah, $idKos);

		if($insert != "Gagal"){
	        for($a=0; $a<sizeof($fasilitas); $a++){
	            $this->model_kamar->insert_fasilitas($insert, $fasilitas[$a]);
	        }

	        redirect('kos/beranda?kos='.$insert.'');
		}
		else {
			echo "Gagal Input";
		}
	}

	public function update()
	{

	}

	public function delete()
	{
		$id = $this->input->get('kamar');
		$this->model_kamar->delete($id);

		redirect('kos/beranda?kos='.$id.'');
	}

	public function beranda()
	{
		if(!empty($this->session->userdata('logged_in_pemilik')))
        {
            $session_data = $this->session->userdata('logged_in_pemilik');
            $data['username'] = $session_data['username'];

            $id = $this->input->get('kamar');
            $data['id'] = $id;

            $data['detail'] = $this->model_kamar->detail_kamar($id);

            if($data['detail']){
            	$data['fasilitas'] = $this->model_kamar->fasilitas_kamar($id);

	            foreach($data['detail'] as $row){
	            	$pemilik = $row->usernamePemilik;
	            }

	            if($data['username'] == $pemilik){
	            	$this->load->view('template/header');
					$this->load->view('beranda_kamar', $data);
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

}
