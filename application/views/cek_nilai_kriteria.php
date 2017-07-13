<!DOCTYPE html>
<html lang="en">

<head>
    <style>
       #cari {
        height: 100%;
        width: 100%;
       }
    </style>
</head>

<body>
	<div class="container">
		<h2>Tabel Perhitungan Kriteria</h2>           
		<table class="table table-bordered">
	    	<thead>
	    		<tr>
	    			<th>Nama Indekos</th>
			      	<th>Jenis Kamar</th>
			        <th>Kriteria 1</th>
			        <th>Kriteria 2</th>
			        <th>Kriteria 3</th>
			        <th>Kriteria 4</th>
			        <th>Kriteria 5</th>
			        <th>Kriteria 6</th>
			        <th>Kriteria 7</th>
			        <th>Kriteria 8</th>
			        <th>Total Nilai</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		<?php
	    			foreach($rekomendasi as $row) { ?>
			    		<tr>
			    			<td><?php echo $row->namaKos ?></td>
			    			<td><?php echo $row->jenisKamar ?></td>
					        <td><?php echo $row->nilaiKriteriaSatu ?></td>
					        <td><?php echo $row->nilaiKriteriaDua ?></td>
					        <td><?php echo $row->nilaiKriteriaTiga ?></td>
					        <td><?php echo $row->nilaiKriteriaEmpat ?></td>
					        <td><?php echo $row->nilaiFasilitasKamar ?></td>
					        <td><?php echo $row->nilaiBanjir ?></td>
					        <td><?php echo $row->nilaiRamai ?></td>
					        <td><?php echo $row->nilaiClusterJurusan ?></td>
					        <td><?php echo ($row->nilaiKriteriaSatu + $row->nilaiKriteriaDua + $row->nilaiKriteriaTiga + $row->nilaiKriteriaEmpat + $row->nilaiFasilitasKamar + $row->nilaiBanjir + $row->nilaiRamai + $row->nilaiClusterJurusan) ?></td>
					    </tr>		
	    			<?php }
	    		?>
	    	</tbody>
	  </table>
	</div>
</body>
</html>