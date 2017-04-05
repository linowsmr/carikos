
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pemesanan</h1>
        </div>
    </div>
    <table class="table table-hover">
		<thead>
		    <tr>
		        <th>ID Pemesanan</th>
		        <th>Nama Pemesan</th>
		        <th>Durasi Pemesanan</th>
		        <th>Harga Pemesanan</th>
		        <th>Indekos</th>
		        <th>Kamar</th>
		   </tr>
		</thead>
		<tbody>
			<?php 
			foreach ($pemesanan as $row) {?>
				<tr>
					<th><?php echo $row->idPemesanan?></th>
					<th><?php echo $row->namaAkun?></th>
					<th><?php echo $row->durasiPemesanan?> bulan</th>
					<th>Rp<?php echo number_format($row->hargaPemesanan)?></th>
					<th><?php echo $row->namaKos?></th>
					<th><?php echo $row->jenisKamar?></th>
				</tr>
			<?php }?>
		</tbody>
	</table>
</div>