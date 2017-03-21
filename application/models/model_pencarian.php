<?php
class Model_Pencarian extends CI_Model {
 	function fasilitas()
 	{
 		$query = "SELECT * FROM fasilitaskos";
		$run = $this->db->query($query);
		return $run->result();
 	}
}