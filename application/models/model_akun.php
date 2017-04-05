<?php
class Model_akun extends CI_Model {
	function cek($username)
	{
		$query = "SELECT username FROM akun WHERE username = '$username'";
 		$run = $this->db->query($query);
 		return $run->num_rows();
	}

	function daftar($username, $password, $nama, $email, $telepon)
	{
	   $data = array(
	   		'USERNAME' => $username,
	   		'PASSWORD' => $password,
	   		'NAMAAKUN' => $nama,
	   		'EMAILAKUN' => $email,
	   		'TELEPONAKUN' => $telepon
	   	);

		$run = $this->db->insert('akun', $data);
		if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function login($username, $password)
 	{
 		$query = "SELECT * FROM akun a WHERE a.username = '$username' AND a.password = '$password'";
		$run = $this->db->query($query);
		if($run->num_rows() == 1)
			return $run->result();
		else
			return false;
 	}

 	function ambil_akun($username)
 	{
 		$query = "SELECT * FROM akun a WHERE a.username = '$username'";
		$run = $this->db->query($query);
		return $run->result();
 	}

}