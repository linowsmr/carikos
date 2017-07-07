<?php
class Model_Cluster extends CI_Model {

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

 	function hapus_cluster()
 	{
 		$query = "DELETE FROM cluster";
		$run = $this->db->query($query);
 	}

 	function hapus_cluster_destinasi()
 	{
 		$query = "DELETE FROM cluster_destinasi";
		$run = $this->db->query($query);
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

 	function cek_destinasi($idCluster, $idDestinasi)
 	{
 		$query = "SELECT * FROM cluster_destinasi cd WHERE cd.idCluster = $idCluster AND cd.idDestinasi = $idDestinasi";
		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function destinasi($idCluster, $idDestinasi, $distance)
 	{
 		$data = array(
	   		'IDCLUSTER' => $idCluster,
	   		'IDDESTINASI' => $idDestinasi,
	   		'JARAKDESTINASI' => $distance
	   	);

	   	$run = $this->db->insert('cluster_destinasi', $data);
 	}

 	function ambil_cluster()
 	{
 		$query = "SELECT * FROM cluster";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function ambil_cluster_id($idCluster)
 	{
 		$query = "SELECT * FROM cluster WHERE idCluster = $idCluster";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function jarak_destinasi($idCluster, $idDestinasi)
 	{
 		$query = "SELECT DISTINCT cd.jarakDestinasi FROM cluster_destinasi cd WHERE cd.idCluster = $idCluster AND cd.idDestinasi = $idDestinasi ORDER BY cd.idClusterDestinasi DESC LIMIT 1";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function luas_parkiran($idKos)
 	{
 		$query = "SELECT k.idParkiranKos FROM kos k WHERE k.idKos = $idKos";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function penjaga_kos($idKos)
 	{
 		$query = "SELECT kf.idKosFasilitasKos FROM kos k, kos_fasilitaskos kf WHERE k.idKos = kf.idKos AND kf.idKos = $idKos AND kf.idFasilitasKos = 4";
		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function fasilitas_lengkap($idKamar)
 	{
 		$query = "SELECT (count(kmf.idKamarFasilitasKamar) + res2.fasilitasDua) as fasilitasTiga FROM kamar_fasilitaskamar kmf, (SELECT (count(kmf.idKamarFasilitasKamar) + res.fasilitasSatu) as fasilitasDua FROM kamar_fasilitaskamar kmf, (SELECT count(kmf.idKamarFasilitasKamar) as fasilitasSatu FROM kamar_fasilitaskamar kmf WHERE kmf.idKamar = $idKamar AND kmf.idFasilitasKamar = 1) res WHERE kmf.idKamar = $idKamar AND kmf.idFasilitasKamar = 2) res2 WHERE kmf.idKamar = $idKamar AND kmf.idFasilitasKamar = 3";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function nilai_destinasi($idCluster, $nilaiDestinasi)
 	{
 		$data = array(
	   		'NILAIDESTINASICLUSTER' => $nilaiDestinasi
	   	);

	   	$this->db->where('IDCLUSTER', $idCluster);
	    $run = $this->db->update('cluster', $data);
 	}

 	function update_nilai_kos($idKos, $nilai)
 	{
 		$data = array(
	   		'NILAIPARKIRANPENJAGAKOS' => $nilai
	   	);

	   	$this->db->where('IDKOS', $idKos);
	    $run = $this->db->update('kos', $data);
 	}

 	function update_nilai_kamar($idKamar, $nilai)
 	{
 		$data = array(
	   		'NILAIFASILITASKAMAR' => $nilai
	   	);

	   	$this->db->where('IDKAMAR', $idKamar);
	    $run = $this->db->update('kamar', $data);
 	}

 	function cek_cluster()
 	{
 		$query = "SELECT * FROM cluster c WHERE c.statusCluster != 1 LIMIT 1";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function cek_cluster_num()
 	{
 		$query = "SELECT * FROM cluster c WHERE c.statusCluster != 1 LIMIT 1";
		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function status_cluster($idCluster, $status)
 	{
 		$data = array(
	   		'STATUSCLUSTER' => $status
	   	);

	   	$this->db->where('IDCLUSTER', $idCluster);
	    $run = $this->db->update('cluster', $data);
 	}

 	function jumlah_cluster()
 	{
 		$query = "SELECT DISTINCT idCluster FROM kos";
 		$run = $this->db->query($query);
		return $run->num_rows();
 	}
}