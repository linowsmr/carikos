<?php
class Model_transaksi extends CI_Model {
 	
 	function transaksi($idPemesanan, $totalBayar,$status)
 	{
 		$data = array(
	   		'IDPEMESANAN' => $idPemesanan,
	   		'TOTALPEMBAYARAN' => $totalBayar,
	   		'STATUS' => $status
	   	);

		$run = $this->db->insert('transaksi', $data);
		if($run) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		else
			return "Gagal";
 	}

 	function data_transaksi()
 	{
 		$query = "SELECT * FROM transaksi";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function verifikasi($idTransaksi,$norek,$namarek,$bank,$status)
 	{
 		$data = array (
 			'NOMORREKENING' => $norek,
 			'NAMATABUNGAN' => $namarek,
 			'BANK' => $bank,
			'STATUS' => $status
		);
		$this->db->where('IDTRANSAKSI',$idTransaksi);
		$run = $this->db->update('transaksi',$data);

		if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function count_transaksi($username)
 	{
 		$query = "SELECT * FROM pemesanan p, transaksi t WHERE p.idPemesanan = t.idPemesanan AND p.usernameAkun = '$username'";
 		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function ambil_transaksi($username)
 	{
 		$query = "SELECT * FROM pemesanan p, transaksi t, akun a, kamar km, kos k WHERE p.idPemesanan = t.idPemesanan AND p.usernameAkun = a.username AND p.idKamar = km.idKamar AND km.idKos = k.idKos AND p.usernameAkun = '$username' ORDER BY t.idTransaksi DESC";
 		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pembatalan_transaksi($transaksi, $status)
 	{
 		$data = array (
 			'STATUS' => $status
		);

		$this->db->where('IDTRANSAKSI',$transaksi);
		$run = $this->db->update('transaksi',$data);
 	}
}