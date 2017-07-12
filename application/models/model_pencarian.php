<?php
class Model_Pencarian extends CI_Model {
 	function pencarian($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.nilaiBanjir, k.nilaiRamai, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, (k.nilaiParkiranPenjagaKos + k.nilaiBanjir + k.nilaiRamai + km.nilaiFasilitasKamar + c.nilaiDestinasiCluster)*0.83 as nilai FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND km.idKamar = foto.idKamar AND k.kotaKos = '$kota' AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) ORDER BY nilai DESC LIMIT 4";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pencarian_semua($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.nilaiBanjir, k.nilaiRamai, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, (k.nilaiParkiranPenjagaKos + k.nilaiBanjir + k.nilaiRamai + km.nilaiFasilitasKamar + c.nilaiDestinasiCluster)*0.83 as nilai FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND km.idKamar = foto.idKamar AND k.kotaKos = '$kota' AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) ORDER BY RAND()";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pencarian_jurusan($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar, $idJurusan)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.nilaiBanjir, k.nilaiRamai, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, cj.nilaiClusterJurusan, (k.nilaiParkiranPenjagaKos + k.nilaiBanjir + k.nilaiRamai + km.nilaiFasilitasKamar + c.nilaiDestinasiCluster + cj.nilaiClusterJurusan) as nilai FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, cluster_jurusan cj, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND c.idCluster = cj.idCluster AND km.idKamar = foto.idKamar AND k.kotaKos = '$kota' AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) AND cj.idJurusan = $idJurusan ORDER BY nilai DESC LIMIT 4";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pencarian_jurusan_semua($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar, $idJurusan)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.nilaiBanjir, k.nilaiRamai, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, cj.nilaiClusterJurusan, (k.nilaiParkiranPenjagaKos + k.nilaiBanjir + k.nilaiRamai + km.nilaiFasilitasKamar + c.nilaiDestinasiCluster + cj.nilaiClusterJurusan) as nilai FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, cluster_jurusan cj, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND c.idCluster = cj.idCluster AND km.idKamar = foto.idKamar AND k.kotaKos = '$kota' AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) AND cj.idJurusan = $idJurusan ORDER BY RAND()";
 	
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

 	function portal()
 	{
 		$query = "SELECT * FROM portal";
 		$run = $this->db->query($query);
 		return $run->result();
 	}
}