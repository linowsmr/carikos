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

 	function jumlah_kamar($idPemesanan)
 	{
 		$query = "SELECT km.idKamar, km.jumlahKamar FROM kamar km, pemesanan p WHERE km.idKamar = p.idKamar AND p.idPemesanan = $idPemesanan";
 		$run = $this->db->query($query);
		return $run->result();
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

<<<<<<< HEAD
 	function updateVerifikasi($idTransaksi,$status)
 	{
 		$data = array (
			'STATUS' => $status
		);
		$this->db->where('IDTRANSAKSI',$idTransaksi);
		$run = $this->db->update('transaksi',$data);

		if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function notifTransaksi()
 	{
 		$query = "SELECT COUNT(*) as totalTransaksi from transaksi where status = 1";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function laporanKeuangan($bulan,$tahun)
 	{
 		$query = "SELECT DISTINCT t.idTransaksi, date(t.tanggalTransaksi) as tanggal, km.hargaKamar, p.durasiPemesanan, p.hargaPemesanan from transaksi t, kamar km, pemesanan p where p.idKamar = km.idKamar and t.idPemesanan = p.idPemesanan and month(t.tanggalTransaksi) = '$bulan' and year(t.tanggalTransaksi) = '$tahun'";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function jumlahTransaksi()
 	{
 		$query = "SELECT km.hargaKamar, p.durasiPemesanan, t.totalPembayaran from transaksi t, kamar km, pemesanan p where t.idPemesanan = p.idPemesanan and p.idKamar = km.idKamar";
 		$run = $this->db->query($query);
 		return $run->result();
=======
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
>>>>>>> aa3a3034562646dea5d37e2533e4dcb52d96fa7d
 	}
}