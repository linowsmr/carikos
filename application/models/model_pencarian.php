<?php
class Model_Pencarian extends CI_Model {
 	function pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, k.namaKos, fkm.namaFileKamar, km.hargaKamar FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, fotokamar fkm WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND km.idKamar = fkm.idKamar AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar)";
		$run = $this->db->query($query);
		return $run->result();
 	}
}