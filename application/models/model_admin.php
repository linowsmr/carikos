<?php
class Model_admin extends CI_Model {

 	function login($username, $password)
 	{
 		$query = "SELECT * FROM admin a WHERE a.username = '$username' AND a.password = '$password'";
		$run = $this->db->query($query);
		if($run->num_rows() == 1)
			return $run->result();
		else
			return false;
 	}

 	function insertPortal($jenisKendaraan,$lat,$lng,$aksesPortal,$waktuBuka,$waktuTutup)
 	{
 		$data = array(
 				'JENISKENDARAANPORTAL' => $jenisKendaraan,
 				'LATPORTAL' => $lat,
 				'LNGPORTAL' => $lng,
 				'AKSESPORTAL' => $aksesPortal,
 				'WAKTUBUKAPORTAL' => $waktuBuka,
 				'WAKTUTUTUPPORTAL' => $waktuTutup
 			);

 		$run = $this->db->insert('portal', $data);
		if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function viewPortal()
	{
		$query = "SELECT * FROM portal";
		$run = $this->db->query($query);
		return $run->result();
	}
}