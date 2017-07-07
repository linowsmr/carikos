<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
 	{
	   	parent::__construct();
	   	$this->load->model('model_admin','',TRUE);
	   	$this->load->model('model_kos','',TRUE);
	   	$this->load->model('model_pemilik','',TRUE);
	   	$this->load->model('model_kamar','',TRUE);
	   	$this->load->model('model_pemesanan','',TRUE);
	   	$this->load->model('model_transaksi','',TRUE);
        $this->load->model('model_promo','',TRUE);
 	}
	public function login(){
		$this->load->library('session');
		$username = $this->input->post('username');
    	$password = $this->input->post('password');

    	$result = $this->model_admin->login($username, $password);

    	if($result){
    		$sess_array = array();
		    foreach($result as $row)
		    {
		    	$sess_array = array(
		        	'username' => $row->username
		        );
		    	$this->session->set_userdata('logged_in_admin', $sess_array);
		    }
		    redirect('admin/beranda');
    	}
    	else
    		echo "Gagal Masuk Session";
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function beranda(){
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();
            $data['kos'] = $this->model_kos->jumlahKos();
            $data['kamar'] = $this->model_kamar->jumlahKamar();
            $data['pemilik'] = $this->model_pemilik->jumlahPemilik();
            $data['transaksi'] = $this->model_transaksi->jumlahTransaksi();

            $this->load->view('admin/admheader', $nama);
            $this->load->view('admin/index', $data);
        }
        else {
            redirect('admin');
        }
	}

	public function logout()
    {
    	$this->session->unset_userdata('logged_in_admin');
   		session_destroy();
   		redirect('admin');
    }
    public function lihatKos()
	{
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();
            $data['kos'] = $this->model_kos->lihatKos();
			$id = $this->input->get('kos');
			$data['id'] = $id;

			$this->load->view('admin/admheader',$nama);
			$this->load->view('admin/indekos', $data);
        }
        else
        {
            redirect('admin');
        }
	}
	public function reservasi()
	{
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();
            $data['pemesanan'] = $this->model_pemesanan->daftar_pemesanan();

			$this->load->view('admin/admheader',$nama);
			$this->load->view('admin/reservasi',$data);
        }
        else
        {
            redirect('admin');
        }
		
	}
	public function trans()
	{
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();
            $data['transaksi'] = $this->model_transaksi->transaksi_data();

			$this->load->view('admin/admheader',$nama);
			$this->load->view('admin/transaksi', $data);
        }
        else
        {
            redirect('admin');
        }
	}
	public function lapkeu()
	{
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $bulan = 0;
            $tahun = 0;
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['transaksi'] = $this->model_transaksi->laporanKeuangan($bulan,$tahun);

            $this->load->view('admin/admheader',$nama);
			$this->load->view('admin/laporan',$data);
        }
        else
        {
            redirect('admin');
        }
	}
	public function lihatKamar()
	{
		if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();

            $id = $this->input->get('kos');
			$data['id'] = $id;
			$data['namaKos'] = $this->model_kos->namaKos($id);
			$data['kamar'] = $this->model_kamar->lihatKamar($id);

			$this->load->view('admin/admheader',$nama);
			$this->load->view('admin/kamar', $data);
        }
        else
        {
            redirect('admin');
        }
		
	}
	public function verTrans()
	{
		$status = 2;
		$idTransaksi = $this->input->post('transaksi');

		$update = $this->model_transaksi->updateVerifikasi($idTransaksi,$status);
		if($cek != 'Gagal'){
			redirect('admin/trans');
		}
		else{
			echo 'gagal';
		}
	}

    public function promo()
    {
        if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();

            $data['promo'] = $this->model_promo->semua_promo();

            $this->load->view('admin/admheader',$nama);
            $this->load->view('admin/daftar_promo', $data);
        }
        else
        {
            redirect('admin');
        }
    }

    public function tambah_promo()
    {
        if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();

            $this->load->view('admin/admheader',$nama);
            $this->load->view('admin/tambah_promo');
        }
        else
        {
            redirect('admin');
        }   
    }

    public function tambah_promo_data()
    {
        $namaPromo = $this->input->post('nama');
        $deskripsiPromo = $this->input->post('deskripsi');
        $potonganHarga = $this->input->post('harga');
        $kodePromo = strtoupper($this->input->post('kode'));
        $mulaiPromo = $this->input->post('mulaiPromo');
        $selesaiPromo = $this->input->post('selesaiPromo');
        if($this->input->post('mulaiSewa') != "")
            $mulaiSewa = $this->input->post('mulaiSewa');
        else
            $mulaiSewa = $this->input->post('mulaiSewa2');

        if($this->input->post('akhirSewa') != "")
            $akhirSewa = $this->input->post('akhirSewa');
        else
            $akhirSewa = $this->input->post('akhirSewa2');
        
        $minimumTransaksi = $this->input->post('transaksi');
        $minimumDurasi = $this->input->post('durasi');

        $extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
        if(isset($_FILES['foto'])){
            $name_array = $_FILES['foto']['name'];
            $tmp_name_array = $_FILES['foto']['tmp_name'];
            
            for($i=0; $i < count($tmp_name_array); $i++){
                $ext=pathinfo($name_array[$i],PATHINFO_EXTENSION);
                //$hash = "-";
                $name_file = $name_array[$i];
                if(in_array($ext,$extension)){
                    if(!file_exists("assets/images/promo/".$name_file)){
                        move_uploaded_file($tmp_name_array[$i], "assets/images/promo/".$name_file);
                        $this->model_promo->insert_promo($namaPromo, $deskripsiPromo, $potonganHarga, $mulaiPromo, $selesaiPromo, $mulaiSewa, $akhirSewa, $minimumTransaksi, $minimumDurasi, $kodePromo, $name_file);
                    }
                    else {
                        $filename = basename($name_file, $ext);
                        $newFileName=$filename.time().".".$ext;
                        move_uploaded_file($tmp_name_array[$i], "assets/images/promo/".$newFileName);
                        $this->model_promo->insert_promo($namaPromo, $deskripsiPromo, $potonganHarga, $mulaiPromo, $selesaiPromo, $mulaiSewa, $akhirSewa, $minimumTransaksi, $minimumDurasi, $kodePromo, $newFileName);
                    }
                }
                else
                    echo "Salah Ekstensi";
            }
        }

        redirect('admin/promo');
    }

    public function portal()
    {
        if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();
            $data['portal'] = $this->model_admin->viewPortal();

            $this->load->view('admin/admheader',$nama);
            $this->load->view('admin/portal',$data);
        }
        else
        {
            redirect('admin');
        }   
    }

    public function tambahPortal()
    {
        if(!empty($this->session->userdata('logged_in_admin')))
        {
            $session_data = $this->session->userdata('logged_in_admin');
            $nama['username'] = $session_data['username'];
            $nama['notifTransaksi'] = $this->model_transaksi->notifTransaksi();

            $this->load->view('admin/admheader',$nama);
            $this->load->view('admin/insertPortal');
        }
        else
        {
            redirect('admin');
        }
    }

    public function insertPortal()
    {
        $jenisKendaraan = $this->input->post('jeniskendaraan');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $aksesportal = $this->input->post('aksesportal');
        $waktubuka = $this->input->post('waktubuka');
        $waktututup = $this->input->post('waktututup');
        echo $jenisKendaraan;

        $input = $this->model_admin->insertPortal($jenisKendaraan,$lat,$lng,$aksesportal,$waktubuka,$waktututup);
        if($input!='Gagal'){
            redirect('admin/portal');
        }
        else{
            echo 'Gagal';
        }
    }
}