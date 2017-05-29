<?php
class Model_jurusan extends CI_Model {

	function ambil_jurusan($idJurusan)
	{
		$query = "SELECT * FROM jurusan WHERE idJurusan = $idJurusan";
		$run = $this->db->query($query);
		return $run->result();
	}

	function ambil_semua_jurusan()
	{
		$query = "SELECT * FROM jurusan";
		$run = $this->db->query($query);
		return $run->result();
	}

	function cek_nilai($idCluster, $idJurusan)
	{
		$query = "SELECT idClusterJurusan FROM cluster_jurusan WHERE idCluster = $idCluster AND idJurusan = $idJurusan";
		$run = $this->db->query($query);
		return $run->num_rows();
	}

	function jarak_cluster_jurusan($idCluster, $idJurusan, $jarak, $nilai)
 	{
 		$query = "UPDATE cluster_jurusan SET jarakClusterJurusan = $jarak, nilaiClusterJurusan = $nilai WHERE idCluster = $idCluster AND idJurusan = $idJurusan";
		$run = $this->db->query($query);
 	}

 	function input_cluster_jurusan($idCluster, $idJurusan, $jarakClusterJurusan, $nilaiClusterJurusan)
 	{
 		$data = array(
	   		'IDCLUSTER' => $idCluster,
	   		'IDJURUSAN' => $idJurusan,
	   		'JARAKCLUSTERJURUSAN' => $jarakClusterJurusan,
	   		'NILAICLUSTERJURUSAN' => $nilaiClusterJurusan
	   	);

		$run = $this->db->insert('cluster_jurusan', $data);
 	}

 	function hapus_cluster_jurusan()
 	{
 		$query = "DELETE FROM cluster_jurusan";
		$run = $this->db->query($query);
 	}

 	function latlng_jurusan($idJurusan, $idCluster)
 	{
 		$query = "SELECT * FROM jurusan j, cluster_jurusan cj WHERE j.idJurusan = cj.idJurusan AND j.idJurusan = $idJurusan AND cj.idCluster = $idCluster";
		$run = $this->db->query($query);
		return $run->result();
 	}
 	
}