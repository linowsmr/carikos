<?php
class Model_pemesanan extends CI_Model {
 	
 	function tambah_pemesanan($masuk, $keluar, $durasi, $harga, $username, $idKamar)
 	{
 		$data = array(
 			'TANGGALMASUK' => $masuk,
 			'TANGGALKELUAR' => $keluar,
	   		'DURASIPEMESANAN' => $durasi,
	   		'HARGAPEMESANAN' => $harga,
	   		'USERNAMEAKUN' => $username,
	   		'IDKAMAR' => $idKamar
	   	);

		$run = $this->db->insert('pemesanan', $data);
		if($run) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		else
			return "Gagal";
 	}

 	function count_pemesanan($pemilik)
 	{
 		$query = "SELECT t.idTransaksi FROM transaksi t, pemesanan p, kamar km, kos k WHERE t.idPemesanan = p.idPemesanan AND p.idKamar = km.idKamar AND km.idKos = k.idKos AND t.status = 0 AND k.usernamePemilik = '$pemilik'";
 		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function ambil_pemesanan($pemilik)
 	{
 		$query = "SELECT * FROM pemesanan p, transaksi t, akun a, kamar km, kos k WHERE p.idPemesanan = t.idPemesanan AND p.usernameAkun = a.username AND p.idKamar = km.idKamar AND km.idKos = k.idKos AND k.usernamePemilik = '$pemilik'";
 		$run = $this->db->query($query);
		return $run->result();
 	}

 	function daftar_pemesanan()
 	{
 		$query = "SELECT  p.idPemesanan, p.durasiPemesanan, p.hargaPemesanan, a.namaAkun, km.jenisKamar, k.namaKos from pemesanan p, kamar km, kos k, akun a where p.usernameAkun = a.username and p.idKamar = km.idKamar and km.idKos = k.idKos";
 		$run = $this->db->query($query);
 		return $run->result();
 	}
}