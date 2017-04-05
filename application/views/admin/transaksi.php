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
		        <th></th>
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
		      			<th>Bank <?php echo $row->bank?></th>
		      			<th><?php echo $row->nomorRekening?></th>
		      			<th><?php echo $row->namaTabungan?></th>
		      			<th><?php $status = $row->status; 
		      				if($status == 0) 
		      				{
		      					echo "Belum bayar";?>
		      					<th>
		      						<form action="<?php echo site_url('admin/verTrans')?>" method="POST">
		      							<input type="hidden" name="transaksi" value="<?php echo $row->idTransaksi?>"></input>
		      							<input type="hidden" name="status" value="1"></input>
		      							<button type="submit" class="btn btn-primary">Verifikasi</button>
		      						</form>
		      					</th>
		      				<?php }
		      				elseif ($status == 1) 
		      				{
		      					echo "Lunas";
		      				}
		      				else
		      				{
		      					echo "Batal";
		      				}?>
		      			</th>
		      		</tr>
		      	<?php }?>
		    </tbody>
		</table>
</div>