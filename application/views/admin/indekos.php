<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Indekos</h1>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
		    <tr>
		        <th>Nama</th>
		        <th>Alamat</th>
		        <th>Telepon</th>
		        <th width="50px">Jumlah Kamar</th>
		        <th>Pemilik</th>
		   </tr>
		</thead>
		<tbody>
		    <?php
		    foreach ($kos as $kos_item) {?>
		      <tr>
		        <td><a href="<?php echo site_url('admin/lihatKamar?kos='.$kos_item['idKos'].'')?>"><?php echo $kos_item['namaKos'] ?></a></td>
		        <td><?php echo $kos_item['alamatKos'] ?></td>
		        <td><?php echo $kos_item['teleponKos'] ?></td>
		        <td><?php echo $kos_item['jumlahKamar'] ?></td>
		        <td><?php echo $kos_item['namaPemilik'] ?></td>
		      <?php } ?>
		</tbody>
	</table>
</div>