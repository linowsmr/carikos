<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Laporan Keuangan</h1>
        </div>
    </div>
    	<form action="<?php echo site_url('admin/lapkeu')?>" method="get">
    		<div class="form-group">
	    		<div class="col-lg-3">
	            	<h4>Bulan:</h4>
		                <select class="form-control selectpicker" name="bulan" title="Tidak Ada yang Dipilih">
		                    <option value="1">Januari</option>
		                    <option value="2">Februari</option>
		                    <option value="3">Maret</option>
		                    <option value="4">April</option>
		                    <option value="5">Mei</option>
		                    <option value="6">Juni</option>
		                    <option value="7">Juli</option>
		                    <option value="8">Agustus</option>
		                    <option value="9">September</option>
		                    <option value="10">Oktober</option>
		                    <option value="11">November</option>
		                    <option value="12">Desember</option>
		                </select>
		    	</div>
		    	<div class="col-lg-3">
		    		<h4>Tahun:</h4>
		    	    	<select class="form-control selectpicker" name="tahun" title="Tidak Ada yang Dipilih">
		                	<option value="<?php echo date("Y")?>"><?php echo date("Y")?></option>
		            	</select>
		    	</div>
		    	<div class="col-lg-3">
		    		<br>
		    		<br>
		    		<button type="submit" class="btn btn-default">Pilih</button>
		    	</div>
        	</div>
        </form>
    	<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID Transaksi</th>
		        <th>Tanggal</th>
		        <th>Harga Asli (Rp)</th>
		        <th>Harga Baru (Rp)</th>
		        <th>Total (Rp)</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php 
		    		$totalSemua = 0;
		    		foreach ($transaksi as $row) {?>
		    		<tr>
		    			<th><?php echo $row->idTransaksi;?></th>
		    			<th><?php echo $row->tanggal;?></th>
		    			<th><?php $hargaAsli = $row->hargaKamar * $row->durasiPemesanan; echo number_format($hargaAsli);?></th>
		    			<th><?php $hargaBaru = $row->hargaPemesanan * $row->durasiPemesanan; echo number_format($hargaBaru);?></th>
		    			<th>
		    				<?php
		    				$total = $hargaBaru - $hargaAsli; 
		    				$totalSemua += $total;
		    				echo number_format($total);?> </th>
		    		</tr>
		    	<?php }?>
		    		<tr>
		    			<th colspan="4" style="text-align: center;"><b>Total</b></th>
		    			<th><?php echo number_format($totalSemua);?></th>
		    		</tr>
		    </tbody>
		</table>
</div>