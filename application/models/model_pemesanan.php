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

}