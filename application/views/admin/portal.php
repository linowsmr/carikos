<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Portal</h1>
            <form action="<?php echo site_url('admin/tambahPortal')?>" method="post">
            	<button type="submit" class="btn btn-success btn-sm">Tambah</button>
            </form>
        </div>
    </div>
    <table class="table table-hover">
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
		        <th><?php echo $row->idPortal ?></th>
		        <th><?php echo $row->jenisKendaraanPortal ?></th>
		        <th><?php echo $row->latPortal ?></th>
		        <th><?php echo $row->lngPortal ?></th>
		        <th><?php echo $row->aksesPortal ?></th>
		        <th><?php echo $row->waktuBukaPortal ?></th>
		        <th><?php echo $row->waktuTutupportal ?></th>
		        
		      <?php } ?>
		</tbody>
	</table>
	
</div>