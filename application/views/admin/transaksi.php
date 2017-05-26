<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Transaksi</h1>
        </div>
    </div>
    	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		    <thead>
		      <tr>
		        <th>ID Transaksi</th>
		        <th>ID Pemesanan</th>
		        <th>Tanggal Pembayaran</th>
		        <th>Total Pembayaran</th>
		        <th>Bank Asal</th>
		        <th>Nomor Rekening</th>
		        <th>Nama Pemilik</th>
		        <th>Status</th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php 
		      	foreach ($transaksi as $row) {?>
		      		<tr>
		      			<td><?php echo $row->idTransaksi?></td>
		      			<td><?php echo $row->idPemesanan?></td>
		      			<td><?php echo $row->tanggalTransaksi?></td>
		      			<td>Rp<?php echo number_format($row->totalPembayaran)?></td>
		      			<td>
		      			<?php
		      				if($row->status == 0 || $row->status == 3){?>
		      				-
		      				<?php }
		      				else {?>
		      				Bank <?php echo $row->bank;}?>
		      			</td>
		      			<td>
		      			<?php 
		      				if($row->status == 0 || $row->status == 3){?>
		      				-
		      				<?php }
		      				else {
		      				echo $row->nomorRekening;}?></td>
		      			<td>
		      			<?php
		      				if($row->status == 0 || $row->status == 3){?>
		      				-
		      				<?php }
		      				else { 
		      				echo $row->namaTabungan;}?>
		      			</td>
		      			<?php
		      				if($row->status == 0) {?>
		      					<td>Belum bayar</td>
		      				<?php }
		      				else if ($row->status == 1) 
		      				{?>
		      					<td><form action="<?php echo site_url('admin/verTrans')?>" method="POST">
		      							<input type="hidden" name="transaksi" value="<?php echo $row->idTransaksi?>"></input>
		      							<button type="submit" class="btn btn-primary">Verifikasi</button>
		      						</form></td>
		      				<?php }
		      				else if ($row->status == 2){?>
		      					<td>Lunas</td>
							<?php }
		      				else if($row->status == 3){?>
		      					<td>Batal</td>
		      				<?php } ?>
		      			</td>
		      		</tr>
		      	<?php }?>
		    </tbody>
		</table>
</div>