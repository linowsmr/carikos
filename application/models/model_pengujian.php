<?php
class Model_Pengujian extends CI_Model {
 	function hapus_nilai() {
   		$query = "DELETE FROM penilaian";
		$run = $this->db->query($query);
 	}

 	function hapus_nilai_cluster() {
 		$query = "DELETE FROM penilaian_cluster";
		$run = $this->db->query($query);
 	}

 	function nilaiSatuDua($idCluster, $nilaiSatu, $nilaiDua) {
 		$data = array(
	   		'IDCLUSTER' => $idCluster,
	   		'NILAIKRITERIASATU' => $nilaiSatu,
	   		'NILAIKRITERIADUA' => $nilaiDua
	   	);

		$run = $this->db->insert('penilaian_cluster', $data);
 	}

 	function nilaiTigaEmpat($idKos, $nilaiTiga, $nilaiEmpat) {
 		$data = array(
	   		'IDKOS' => $idKos,
	   		'NILAIKRITERIATIGA' => $nilaiTiga,
	   		'NILAIKRITERIAEMPAT' => $nilaiEmpat
	   	);

		$run = $this->db->insert('penilaian', $data);
 	}

 	function pencarian($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.nilaiBanjir, k.nilaiRamai, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, (k.nilaiParkiranPenjagaKos + k.nilaiBanjir + k.nilaiRamai + km.nilaiFasilitasKamar + c.nilaiDestinasiCluster)*0.83 as nilai, pc.nilaiKriteriaSatu, pc.nilaiKriteriaDua, p.nilaiKriteriaTiga, p.nilaiKriteriaEmpat FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto, penilaian_cluster pc, penilaian p WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND km.idKamar = foto.idKamar AND k.kotaKos = '$kota' AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) AND k.idKos = p.idKos AND pc.idCluster = c.idCluster ORDER BY nilai DESC";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pencarian_jurusan($kota, $minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar, $idJurusan)
 	{
 		$query = "SELECT DISTINCT km.idKamar, km.jenisKamar, km.jumlahKamar, k.idKos, k.namaKos, k.latLngKos, k.nilaiParkiranPenjagaKos, k.nilaiBanjir, k.nilaiRamai, k.idCluster, km.hargaKamar, km.nilaiFasilitasKamar, foto.namaFileKamar, c.nilaiDestinasiCluster, cj.nilaiClusterJurusan, (k.nilaiParkiranPenjagaKos + k.nilaiBanjir + k.nilaiRamai + km.nilaiFasilitasKamar + c.nilaiDestinasiCluster + cj.nilaiClusterJurusan) as nilai, pc.nilaiKriteriaSatu, pc.nilaiKriteriaDua, p.nilaiKriteriaTiga, p.nilaiKriteriaEmpat FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf, cluster c, cluster_jurusan cj, (SELECT namaFileKamar, idKamar FROM fotokamar group by (idKamar)) foto, penilaian_cluster pc, penilaian p WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND k.idCluster = c.idCluster AND c.idCluster = cj.idCluster AND km.idKamar = foto.idKamar AND k.kotaKos = '$kota' AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar) AND cj.idJurusan = $idJurusan  AND k.idKos = p.idKos AND pc.idCluster = c.idCluster ORDER BY nilai DESC";
 	
		$run = $this->db->query($query);
		return $run->result();
 	}
}