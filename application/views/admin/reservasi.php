
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pemesanan</h1>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
					<td><?php echo $row->idPemesanan?></td>
					<td><?php echo $row->namaAkun?></td>
					<td><?php echo $row->durasiPemesanan?> bulan</td>
					<td>Rp<?php echo number_format($row->hargaPemesanan)?></td>
					<td><?php echo $row->namaKos?></td>
					<td><?php echo $row->jenisKamar?></td>
				</tr>
			<?php }?>
		</tbody>
	</table>
</div>