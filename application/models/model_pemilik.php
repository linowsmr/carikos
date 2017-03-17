<?php
class Model_pemilik extends CI_Model {
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
		$run = $this->db->query($query);
		if($run->num_rows() == 1)
			return $run->result();
		else
			return false;
 	}

 	function jumlahPemilik()
 	{
 		$query = "SELECT COUNT(*) as total from pemilik";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

}