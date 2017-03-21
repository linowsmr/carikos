<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Indekos</h1>
        </div>
    </div>
    <table class="table table-hover">
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
		        <th><?php echo $kos_item['namaKos'] ?></th>
		        <th><?php echo $kos_item['alamatKos'] ?></th>
		        <th><?php echo $kos_item['teleponKos'] ?></th>
		        <th><?php echo $kos_item['jumlahKamar'] ?></th>
		        <th><?php echo $kos_item['namaPemilik'] ?></th>
		      </tr>
		      <?php } ?>
		</tbody>
	</table>
</div>