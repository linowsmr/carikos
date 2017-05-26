<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php foreach ($namaKos as $namaKos_item) {?>
            	<?php echo $namaKos_item->namaKos?><?php } ?></h1>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
		    <tr>
		        <th>Jenis Kamar</th>
		        <th>Jumlah Kamar</th>
		        <th>Harga (Rp.)</th>
		   </tr>
		</thead>
		<tbody>
		    <?php
		    foreach ($kamar as $kamar_item) {?>
		      <tr>
		        <td><?php echo $kamar_item->jenisKamar ?></td>
		        <td><?php echo $kamar_item->jumlahKamar ?></td>
		        <td><?php echo number_format($kamar_item->hargaKamar) ?></td>
		      <?php } ?>
		</tbody>
	</table>
	<a href="<?php echo site_url('admin/lihatKos')?>"><button type="button" class="btn btn-default">Kembali</button></a>
</div>