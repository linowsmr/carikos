<?php
class Model_jurusan extends CI_Model {

	function ambil_semua_jurusan()
	{
		$query = "SELECT * FROM jurusan";
		$run = $this->db->query($query);
		return $run->result();
	}

	function cek_nilai($idCluster, $idJurusan)
	{
		$query = "SELECT idClusterJurusan FROM cluster_jurusan WHERE idCluster = $idCluster AND idJurusan = $idJurusan AND nilaiClusterJurusan IS NULL";
		$run = $this->db->query($query);
		return $run->num_rows();
	}

	function jarak_cluster_jurusan($idCluster, $idJurusan, $jarak, $nilai)
 	{
 		$query = "UPDATE cluster_jurusan SET jarakClusterJurusan = $jarak, nilaiClusterJurusan = $nilai WHERE idCluster = $idCluster AND idJurusan = $idJurusan";
		$run = $this->db->query($query);
 	}

 	function input_cluster_jurusan($idCluster, $idJurusan)
 	{
 		$data = array(
	   		'IDCLUSTER' => $idCluster,
	   		'IDJURUSAN' => $idJurusan
	   	);

		$run = $this->db->insert('cluster_jurusan', $data);
 	}

 	function hapus_cluster_jurusan()
 	{
 		$query = "DELETE FROM cluster_jurusan";
		$run = $this->db->query($query);
 	}

 	function latlng_jurusan($idJurusan)
 	{
 		$query = "SELECT idJurusan, latJurusan, lngJurusan FROM jurusan where idJurusan = $idJurusan";
		$run = $this->db->query($query);
		return $run->result();
 	}
 	
}