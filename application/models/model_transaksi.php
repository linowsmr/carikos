<?php
class Model_transaksi extends CI_Model {
 	
 	function transaksi($idPemesanan, $promo, $totalBayar,$status)
 	{
 		$data = array(
	   		'IDPEMESANAN' => $idPemesanan,
	   		'IDPROMO' => $promo,
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

 	function transaksi_data()
 	{
 		$query = "SELECT * FROM transaksi";
 		$run = $this->db->query($query);
 		return $run->result();
 	}
 	function data_transaksi($idTransaksi)
 	{
 		$query = "SELECT * FROM transaksi t WHERE t.idTransaksi= $idTransaksi";
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

 	function eticket($idTransaksi)
 	{
 		$query = "SELECT distinct t.idTransaksi, p.tanggalMasuk, p.tanggalKeluar, km.jenisKamar, fk.namaFileKamar, k.namaKos, k.alamatKos, k.teleponKos, a.namaAkun, fks.namaFile from transaksi t, pemesanan p, kamar km, kos k, fotokamar fk, akun a, fotokos fks where t.idTransaksi = '$idTransaksi'and t.idPemesanan = p.idPemesanan and p.idKamar = km.idKamar and km.idKamar = fk.idKamar and km.idKos = k.idKos and k.idKos = fks.namaFile and p.usernameAkun = a.username";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function cek_transaksi($id)
 	{
 		$query = "SELECT a.username FROM pemesanan p, transaksi t, akun a, kamar km, kos k WHERE p.idPemesanan = t.idPemesanan AND p.usernameAkun = a.username AND p.idKamar = km.idKamar AND km.idKos = k.idKos AND t.idTransaksi = '$id'";
 		$run = $this->db->query($query);
		return $run->result();
 	}
}