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
}