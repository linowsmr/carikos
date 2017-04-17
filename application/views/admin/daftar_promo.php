<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Promo</h1>
        </div>
    </div>
    <table class="table table-hover">
		<thead>
		    <tr>
		        <th>Nama Promo</th>
		        <th>Kode Promo</th>
		        <th>Potongan Harga</th>
		   </tr>
		</thead>
		<tbody>
		    <?php
		    foreach ($promo as $row) {?>
		      <tr>
		        <th><?php echo $row->namaPromo ?></th>
		        <th><?php echo $row->kodePromo ?></th>
		        <th>Rp<?php echo number_format($row->potonganHarga) ?></th>
		      <tr>
		      <?php } ?>
		</tbody>
	</table>
</div>