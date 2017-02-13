<?php
Class Model_pemilik extends CI_Model
{
	function daftar($username, $password, $nama, $email, $telepon)
	{
	   $data = array(
	   		'USERNAMEPEMILIK' => $username,
	   		'PASSWORDPEMILIK' => $password,
	   		'NAMAPEMILIK' => $nama,
	   		'EMAILPEMILIK' => $email,
	   		'TELEPONPEMILIK' => $telepon
	   	);

		$run = $this->db->insert('pemilik', $data);
		if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function login($username, $password)
 	{
 		$query = "SELECT * FROM pemilik p WHERE p.usernamepemilik = '$username' AND p.passwordpemilik = '$password'";
		$result = $this->db->query($query);
		if($result->num_rows() == 1)
			return $result->result();
		else
			return false;
 	}

}