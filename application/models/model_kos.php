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

 	function parkiran()
 	{
 		$query = "SELECT * FROM parkirankos";
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

 	function list_foto($id)
 	{
 		$query = "SELECT * FROM fotokos fk WHERE fk.idKos = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function insert($nama, $alamat, $latlng, $telepon, $tipe, $parkiran, $pemilik)
 	{
 		$data = array(
	   		'NAMAKOS' => $nama,
	   		'ALAMATKOS' => $alamat,
	   		'LATLNGKOS' => $latlng,
	   		'TELEPONKOS' => $telepon,
	   		'IDTIPEKOS' => $idTipeKos,
	   		'IDPARKIRANKOS' => $parkiran,
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

 	function insert_foto($id, $image)
 	{
 		$data = array(
	   		'NAMAFILE' => $image,
	   		'IDKOS' => $id
	   	);

		$run = $this->db->insert('fotokos', $data);
		// if($run)
		// 	return "Berhasil";
		// else
		// 	return "Gagal";
 	}

 	function detail_kos($id)
 	{
 		$query = "SELECT * FROM kos k, parkirankos pk WHERE k.idParkiranKos = pk.idParkiranKos AND k.idKos = '$id'";
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
 		$query = "SELECT * FROM kos k, tipekos tk WHERE k.idTipeKos = tk.idTipeKos AND k.idKos = '$id'";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function update($id, $nama, $alamat, $telepon, $parkiran)
 	{
 		$data = array (
					'NAMAKOS' => $nama,
			   		'ALAMATKOS' => $alamat,
			   		'TELEPONKOS' => $telepon,
			   		'IDPARKIRANKOS' => $parkiran
		);

		$this->db->where('IDKOS', $id);
	    $run = $this->db->update('kos', $data);

	    if($run)
			return "Berhasil";
		else
			return "Gagal";
 	}

 	function delete_fasilitas_kos($id)
 	{
 		$this->db->where('idKos', $id);
   		$this->db->delete('kos_fasilitaskos');
 	}

 	function delete_tipe_kos($id)
 	{
 		$this->db->where('idKos', $id);
   		$this->db->delete('kos_tipekos');
 	}

 	function delete_foto_kos($id)
 	{
 		$this->db->where('idKos', $id);
   		$this->db->delete('fotokos');
 	}

 	function delete($id)
 	{
 		$this->db->where('idKos', $id);
   		$this->db->delete('kos');
 	}

 	function tipe_kos_non($id)
 	{
 		$query = "SELECT * FROM tipekos t WHERE t.idTipeKos NOT IN (SELECT kt.idTipeKos FROM kos_tipekos kt, tipekos tk WHERE kt.idTipeKos = tk.idTipeKos AND kt.idKos = '$id')";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function fasilitas_kos_non($id)
 	{
 		$query = "SELECT * FROM fasilitaskos f WHERE f.idFasilitasKos NOT IN (SELECT kf.idFasilitasKos FROM kos_fasilitaskos kf, fasilitaskos fk WHERE kf.idFasilitasKos = fk.idFasilitasKos AND kf.idKos = '$id')";
		$run = $this->db->query($query);
		return $run->result();
 	}

 	function hapus_tipe($id)
 	{
 		$this->db->where('idKosTipeKos', $id);
 		$this->db->delete('kos_tipekos');
 	}

 	function hapus_fasilitas($id)
 	{
 		$this->db->where('idKosFasilitasKos', $id);
 		$this->db->delete('kos_fasilitaskos');
 	}

 	function hapus_foto($id)
 	{
 		$this->db->where('idFotoKos', $id);
 		$this->db->delete('fotokos');
 	}
 	function lihatKos()
 	{
 		$query = "SELECT k.namaKos, k.alamatKos, k.teleponKos, p.namaPemilik, (SELECT SUM(jumlahKamar) FROM kamar km WHERE km.idKos = k.idKos) as jumlahKamar From kos k, pemilik p WHERE k.usernamePemilik = p.usernamePemilik";
 		$run = $this->db->query($query);
 		return $run->result_array();
 	}
}