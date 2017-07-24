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
	<div class=" col-lg-3 container">
		<h2>Tabel Perhitungan Kriteria</h2>     
		<table class="table table-bordered">
	    	<tbody>
	    		<?php
	    			foreach($rekomendasi as $row) { 
	    				if($row->idKos == 145) { ?>
				    		<tr>
						        <th>Kriteria 1</th>
						        <td><?php echo $row->nilaiKriteriaSatu ?></td>
						    </tr>
						    <tr>
						    	<th>Kriteria 2</th>
						        <td><?php echo $row->nilaiKriteriaDua ?></td>
						    </tr>
						    <tr>
						        <th>Kriteria 3</th>
						        <td><?php echo $row->nilaiKriteriaTiga ?></td>
						    </tr>
						    <tr>
						    	<th>Kriteria 4</th>
						        <td><?php echo $row->nilaiKriteriaEmpat ?></td>
						    </tr>
						    <tr>
						    	<th>Kriteria 5</th>
						        <td><?php echo $row->nilaiFasilitasKamar ?></td>
						    </tr>
						    <tr>
						    	<th>Kriteria 6</th>
						        <td><?php echo $row->nilaiBanjir ?></td>
						    </tr>
						    <tr>
						    	<th>Kriteria 7</th>
						        <td><?php echo $row->nilaiRamai ?></td>
						    </tr>
						    <tr>
						    	<th>Kriteria 8</th>
						        <td><?php echo $row->nilaiClusterJurusan ?></td>
						    </tr>
						    <tr>
						   		<th>Total</th>
						        <td><?php echo ($row->nilaiKriteriaSatu + $row->nilaiKriteriaDua + $row->nilaiKriteriaTiga + $row->nilaiKriteriaEmpat + $row->nilaiFasilitasKamar + $row->nilaiBanjir + $row->nilaiRamai + $row->nilaiClusterJurusan) ?></td>
						    </tr>		
	    				<?php }
	    			}
	    		?>
	    	</tbody>
	  </table>
	</div>
</body>
</html>