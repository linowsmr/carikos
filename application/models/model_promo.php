<?php
class Model_promo extends CI_Model {

 	function ambil_promo($tanggal)
 	{
 		$query = "SELECT * FROM promo WHERE '$tanggal' >= periodeBookingMulai AND '$tanggal' <= periodeBookingSelesai";
		$run = $this->db->query($query);
		return $run->result();
 	}

}