<?php
class Model_Pencarian extends CI_Model {
 	function pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND km.idKamar = foto.idKamar AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar)";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pencarian_jurusan($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar, $idJurusan)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, cj.nilaiClusterJurusan FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, cluster_jurusan cj, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND c.idCluster = cj.idCluster AND km.idKamar = foto.idKamar AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) AND cj.idJurusan = $idJurusan";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function list_jurusan()
 	{
 		$query = "SELECT * FROM jurusan ORDER BY namaJurusan ASC";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function ambil_jurusan($idJurusan)
 	{
 		$query = "SELECT * FROM jurusan WHERE idJurusan = $idJurusan";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function bp()	
 	{
 		$query = "SELECT * FROM bp";
 		$run = $this->db->query($query);
 		return $run->result();
 	}
}