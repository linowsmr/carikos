<?php
class Model_Pencarian extends CI_Model {
 	function pencarian($minHarga, $maxHarga, $tipe, $fasilitaskos, $fasilitaskamar)
 	{
 		$query = "SELECT DISTINCT km.idKamar FROM kos k, kos_fasilitaskos kf, kamar km, kamar_fasilitaskamar kmf WHERE k.idKos = kf.idKos AND k.idKos = km.idKos AND km.idKamar = kmf.idKamar AND km.hargaKamar >= $minHarga AND km.hargaKamar <= $maxHarga AND k.idTipekos = $tipe AND kf.idFasilitasKos IN ($fasilitaskos) AND kmf.idFasilitasKamar IN ($fasilitaskamar)";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function data_latlng()
 	{
 		$query = "SELECT k.latLngKos FROM kos k";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function pencarian_by_latlng($latlng)
 	{
 		$query = "SELECT k.idKos FROM kos k WHERE k.latLngKos = '$latlng'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function cluster($latlngcluster)
 	{
 		$data = array(
	   		'LATLNGCLUSTER' => $latlngcluster
	   	);

		$run = $this->db->insert('cluster', $data);
		if($run) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		else
			return "Gagal";
 	}

 	function update_idcluster($idKos, $idCluster)
 	{
 		$data = array (
					'IDCLUSTER' => $idCluster
		);

		$this->db->where('IDKOS', $idKos);
	    $run = $this->db->update('kos', $data);
 	}
}