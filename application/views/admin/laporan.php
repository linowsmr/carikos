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
        	</br>
        </form>
        	</br>
        	</br>
        	</br>
	        <?php if($bulan > 0){?>
	        <h2>Laporan Bulan 
	        <?php 
	        	if($bulan == 1)
	        		$bln = "Januari";
	        	if($bulan == 2)
	        		$bln = "Februari";
	        	if($bulan == 3)
	        		$bln = "Maret";
	        	if($bulan == 4)
	        		$bln = "April";
	        	if($bulan == 5)
	        		$bln = "Mei";
	        	if($bulan == 6)
	        		$bln = "Juni";
	        	if($bulan == 7)
	        		$bln = "Juli";
	        	if($bulan == 8)
	        		$bln = "Agustus";
	        	if($bulan == 9)
	        		$bln = "September";
	        	if($bulan == 10)
	        		$bln = "Oktober";
	        	if($bulan == 11)
	        		$bln = "November";
	        	if($bulan == 12)
	        		$bln = "Desember";
	        	echo $bln;?> <?php echo $tahun;?></h2><?php }?>
    	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
		    			<td><?php echo $row->idTransaksi;?></td>
		    			<td><?php echo $row->tanggal;?></td>
		    			<td><?php $hargaAsli = $row->hargaKamar * $row->durasiPemesanan; echo number_format($hargaAsli);?></td>
		    			<td><?php $hargaBaru = $row->hargaPemesanan * $row->durasiPemesanan; echo number_format($hargaBaru);?></td>
		    			<td>
		    				<?php
		    				$total = $hargaBaru - $hargaAsli; 
		    				$totalSemua += $total;
		    				echo number_format($total);?> </td>
		    		</tr>
		    	<?php }?>
		    </tbody>
		    <tfoot>
		    	<tr>
		    		<th colspan="4" style="text-align: center;"><b>Total</b></th>
		    		<th><?php echo number_format($totalSemua);?></th>
		    	</tr>
		    </tfoot>
		</table>
</div>