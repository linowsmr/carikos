<?php
class Model_kos extends CI_Model {
 	function fasilitas()
 	{
 		$query = "SELECT * FROM fasilitaskos";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function tipe()
 	{
 		$query = "SELECT * FROM tipekos";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function count_list($pemilik)
 	{
 		$query = "SELECT * FROM kos WHERE usernamePemilik = '$pemilik'";
		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function list_kos($pemilik)
 	{
 		$query = "SELECT * FROM kos WHERE usernamePemilik = '$pemilik'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function insert($nama, $alamat, $telepon, $pemilik)
 	{
 		$data = array(
	   		'NAMAKOS' => $nama,
	   		'ALAMATKOS' => $alamat,
	   		'TELEPONKOS' => $telepon,
	   		'USERNAMEPEMILIK' => $pemilik
	   	);

		$run = $this->db->insert('kos', $data);
		if($run) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		else
			return "Gagal";
 	}

 	function insert_tipe($id, $tipe)
 	{
 		$data = array(
	   		'IDKOS' => $id,
	   		'IDTIPEKOS' => $tipe
	   	);

		$run = $this->db->insert('kos_tipekos', $data);
		// if($run)
		// 	return "Berhasil";
		// else
		// 	return "Gagal";
 	}

 	function insert_fasilitas($id, $fasilitas)
 	{
 		$data = array(
	   		'IDKOS' => $id,
	   		'IDFASILITASKOS' => $fasilitas
	   	);

		$run = $this->db->insert('kos_fasilitaskos', $data);
		// if($run)
		// 	return "Berhasil";
		// else
		// 	return "Gagal";
 	}

 	function detail_kos($id)
 	{
 		$query = "SELECT * FROM kos WHERE idKos = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function fasilitas_kos($id)
 	{
 		$query = "SELECT * FROM kos_fasilitaskos kf, fasilitaskos fk WHERE kf.idFasilitasKos = fk.idFasilitasKos AND kf.idKos = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function tipe_kos($id)
 	{
 		$query = "SELECT * FROM kos_tipekos kt, tipekos tk WHERE kt.idTipeKos = tk.idTipeKos AND kt.idKos = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function delete($id)
 	{
 		$this->db->where('idKos', $id);
   		$this->db->delete('kos');
 	}
}