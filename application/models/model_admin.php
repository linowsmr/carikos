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

}