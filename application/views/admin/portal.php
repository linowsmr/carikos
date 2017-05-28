<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Portal</h1>
            <form action="<?php echo site_url('admin/tambahPortal')?>" method="post">
            	<button type="submit" class="btn btn-success btn-sm">Tambah</button>
            </form>
        </div>
    </div>
    <br>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
		    <tr>
		        <th>ID Portal</th>
		        <th>Jenis Kendaraan</th>
		        <th>Latitude</th>
		        <th>Longitude</th>
		        <th>Akses Portal</th>
		        <th>Waktu Buka Portal</th>
		        <th>Waktu Tutup Portal</th>
		   </tr>
		</thead>
		<tbody>
		    <?php
		    foreach ($portal as $row) {?>
		      <tr>
		        <td><?php echo $row->idPortal ?></td>
		        <td><?php echo $row->jenisKendaraanPortal ?></td>
		        <td><?php echo $row->latPortal ?></td>
		        <td><?php echo $row->lngPortal ?></td>
		        <td><?php echo $row->aksesPortal ?></td>
		        <td><?php echo $row->waktuBukaPortal ?></td>
		        <td><?php echo $row->waktuTutupportal ?></td>
		        
		      <?php } ?>
		</tbody>
	</table>
	
</div>