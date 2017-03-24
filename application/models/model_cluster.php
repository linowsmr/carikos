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

 	function add($id)
 	{
 		$data = array(
	   		'ID' => $id
	   	);

		$run = $this->db->insert('tes', $data);
 	}
}