<?php
class Model_promo extends CI_Model {

 	function ambil_promo($tanggal)
 	{
 		$query = "SELECT * FROM promo WHERE '$tanggal' >= periodeBookingMulai AND '$tanggal' <= periodeBookingSelesai";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function detail_promo($idPromo)
 	{
 		$query = "SELECT * FROM promo WHERE idPromo = $idPromo";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function cek_promo($kode)
 	{
 		$query = "SELECT * FROM promo WHERE kodePromo = '$kode'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function semua_promo()
 	{
 		$query = "SELECT * FROM promo WHERE idPromo != 0";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function insert_promo($nama, $deskripsi, $potongan, $mulaiPromo, $selesaiPromo, $mulaiSewa, $akhirSewa, $transaksi, $durasi, $kode, $foto)
 	{
 		$data = array(
	   		'NAMAPROMO' => $nama,
	   		'DESKRIPSIPROMO' => $deskripsi,
	   		'POTONGANHARGA' => $potongan,
	   		'PERIODEBOOKINGMULAI' => $mulaiPromo,
	   		'PERIODEBOOKINGSELESAI' => $selesaiPromo,
	   		'PERIODESEWAMULAI' => $mulaiSewa,
	   		'PERIODESEWAAKHIR' => $akhirSewa,
	   		'MINIMUMTRANSAKSI' => $transaksi,
	   		'MINIMUMDURASIPEMESANAN' => $durasi,
	   		'KODEPROMO' => $kode,
	   		'FOTOPROMO' => $foto
	   	);

		$run = $this->db->insert('promo', $data);
 	}
}