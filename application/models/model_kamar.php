<?php
class Model_kamar extends CI_Model {
 	function fasilitas()
 	{
 		$query = "SELECT * FROM fasilitaskamar";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function insert($jenis, $harga, $jumlah, $luas, $id)
 	{
 		$data = array(
	   		'JENISKAMAR' => $jenis,
	   		'HARGAKAMAR' => $harga,
	   		'JUMLAHKAMAR' => $jumlah,
	   		'LUASKAMAR' => $luas,
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

 	function fasilitas_kamar_non($id)
 	{
 		$query = "SELECT * FROM fasilitaskamar f WHERE f.idFasilitasKamar NOT IN (SELECT kf.idFasilitasKamar FROM kamar_fasilitaskamar kf, fasilitaskamar fk WHERE kf.idFasilitasKamar = fk.idFasilitasKamar AND kf.idKamar = '$id')";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function hapus_fasilitas($id)
 	{
 		$this->db->where('idKamarFasilitasKamar', $id);
 		$this->db->delete('kamar_fasilitaskamar');
 	}

 	function update($id, $jenis, $harga, $jumlah)
 	{
 		$data = array(
	   		'JENISKAMAR' => $jenis,
	   		'HARGAKAMAR' => $harga,
	   		'JUMLAHKAMAR' => $jumlah
	   	);

	   	$this->db->where('IDKAMAR', $id);
	    $run = $this->db->update('kamar', $data);

	    if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function delete_fasilitas_kamar($id)
 	{
 		$this->db->where('idKamar', $id);
   		$this->db->delete('kamar_fasilitaskamar');
 	}

 	function delete_foto_kamar($id)
 	{
 		$this->db->where('idKamar', $id);
   		$this->db->delete('fotokamar');
 	}

 	function delete($id)
 	{
 		$this->db->where('idKamar', $id);
   		$this->db->delete('kamar');
 	}

 	function insert_foto($id, $image)
 	{
 		$data = array(
	   		'NAMAFILEKAMAR' => $image,
	   		'IDKAMAR' => $id
	   	);

		$run = $this->db->insert('fotokamar', $data);
		// if($run)
		// 	return "Berhasil";
		// else
		// 	return "Gagal";
 	}

 	function list_foto($id)
 	{
 		$query = "SELECT * FROM fotokamar fk WHERE fk.idKamar = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function hapus_foto($id)
 	{
 		$this->db->where('idFotoKamar', $id);
 		$this->db->delete('fotokamar');
 	}
 	
 	function jumlahKamar()
 	{
 		$query = "SELECT SUM(jumlahKamar) as totalKamar FROM kamar km, kos k WHERE km.idKos = k.idKos";
 		$run = $this->db->query($query);
 		return $run->result();
 	}
 	
 	function lihatKamar($id)
 	{
 		$query = "SELECT * FROM kamar where idKos = '$id'";
 		$run = $this->db->query($query);
 		return $run->result();
 	}

 	function terpakai()
 	{
 		$query = "SELECT p.idKamar, count(p.idKamar) as jmlKamar FROM pemesanan p, transaksi t WHERE p.idPemesanan = t.idPemesanan AND t.status != 3 GROUP BY (p.idKamar)";
 		$run = $this->db->query($query);
 		return $run->result();
 	}
}	