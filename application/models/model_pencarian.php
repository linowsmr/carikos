<?php
class Model_Pencarian extends CI_Model {
 	function pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, k.idKos, k.namaKos, fkm.namaFileKamar, km.hargaKamar, c.nilaiDestinasiCluster FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, fotokamar fkm, cluster c WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND km.idKamar = fkm.idKamar AND k.idCluster = c.idCluster AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar)";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}
 	
 	function bp()
 	{
 		$query = "SELECT * FROM bp";
 		$run = $this->db->query($query);
 		return $run->result;
 	}
}