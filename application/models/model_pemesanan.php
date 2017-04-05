<?php
class Model_pemesanan extends CI_Model {
 	
 	function tambah_pemesanan($durasi, $harga, $username, $idKamar)
 	{
 		$data = array(
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
}