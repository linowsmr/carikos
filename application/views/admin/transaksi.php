<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Transaksi</h1>
        </div>
    </div>
    	<table class="table table-hover">
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
		      			<th><?php echo $row->idTransaksi?></th>
		      			<th><?php echo $row->idPemesanan?></th>
		      			<th><?php echo $row->tanggalTransaksi?></th>
		      			<th>Rp<?php echo number_format($row->totalPembayaran)?></th>
		      			<th>
		      			<?php
		      				if($row->status == 0 || $row->status == 3){?>
		      				-
		      				<?php }
		      				else {?>
		      				Bank <?php echo $row->bank;}?>
		      			</th>
		      			<th>
		      			<?php 
		      				if($row->status == 0 || $row->status == 3){?>
		      				-
		      				<?php }
		      				else {
		      				echo $row->nomorRekening;}?></th>
		      			<th>
		      			<?php
		      				if($row->status == 0 || $row->status == 3){?>
		      				-
		      				<?php }
		      				else { 
		      				echo $row->namaTabungan;}?>
		      			</th>
		      			<?php
		      				if($row->status == 0) {?>
		      					<th>Belum bayar</th>
		      				<?php }
		      				else if ($row->status == 1) 
		      				{?>
		      					<th><form action="<?php echo site_url('admin/verTrans')?>" method="POST">
		      							<input type="hidden" name="transaksi" value="<?php echo $row->idTransaksi?>"></input>
		      							<button type="submit" class="btn btn-primary">Verifikasi</button>
		      						</form></th>
		      				<?php }
		      				else if ($row->status == 2){?>
		      					<th>Lunas</th>
							<?php }
		      				else if($row->status == 3){?>
		      					<th>Batal</th>
		      				<?php } ?>
		      			</th>
		      		</tr>
		      	<?php }?>
		    </tbody>
		</table>
</div>