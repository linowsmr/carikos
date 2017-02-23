<?php
class Model_kamar extends CI_Model {
 	function fasilitas()
 	{
 		$query = "SELECT * FROM fasilitaskamar";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function insert($jenis, $harga, $jumlah, $id)
 	{
 		$data = array(
	   		'JENISKAMAR' => $jenis,
	   		'HARGAKAMAR' => $harga,
	   		'JUMLAHKAMAR' => $jumlah,
	   		'IDKOS' => $id
	   	);

		$run = $this->db->insert('kamar', $data);
		if($run) {
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
		else
			return "Gagal";
 	}

 	function insert_fasilitas($id, $fasilitas)
 	{
 		$data = array(
	   		'IDKAMAR' => $id,
	   		'IDFASILITASKAMAR' => $fasilitas
	   	);

		$run = $this->db->insert('kamar_fasilitaskamar', $data);
		// if($run)
		// 	return "Berhasil";
		// else
		// 	return "Gagal";
 	}

 	function list_kamar($id)
	{
		$query = "SELECT * FROM kamar WHERE idKos = '$id'";
		$run = $this->db->query($query);
		return $run->result();
	}

	function count_list($id)
 	{
 		$query = "SELECT * FROM kamar WHERE idKos = '$id'";
		$run = $this->db->query($query);
		return $run->num_rows();
 	}

 	function detail_kamar($id)
 	{
 		$query = "SELECT * FROM kamar km, kos k WHERE km.idKos = k.idKos AND km.idKamar = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function fasilitas_kamar($id)
 	{
 		$query = "SELECT * FROM kamar_fasilitaskamar kf, fasilitaskamar fm WHERE kf.idFasilitasKamar = fm.idFasilitasKamar AND kf.idKamar = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function delete($id)
 	{
 		$this->db->where('idKamar', $id);
   		$this->db->delete('kamar');
 	}
}	