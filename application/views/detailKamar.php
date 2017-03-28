<!DOCTYPE html>
<html lang="en">
	<body>

	    <!-- Navigation -->
	    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
	    <nav id="sidebar-wrapper">
	        <ul class="sidebar-nav">
	            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
	            <li class="sidebar-brand">
	                <a href="#top" onclick=$("#menu-close").click();>CariKos</a>
	            </li>
	            <li>
	                <a href="#top" onclick=$("#menu-close").click();>Beranda</a>
	            </li>
	            <li>
	                <a href="#tentang" onclick=$("#menu-close").click();>Tentang</a>
	            </li>
	            <li>
	                <a href="#cari" onclick=$("#menu-close").click();>Cari Kos</a>
	            </li>
	            <li>
	                <a href="#daftar" onclick=$("#menu-close").click();>Daftar Kos</a>
	            </li>
	        </ul>
	    </nav>

	    <div id="top"></div>
    	<aside class="call-to-action">
    		<div class="container">
    			<div class="row">
    			 	<div class="col-lg-12 text-center">
    			 	 	<h2><?php foreach ($detailKos as $row) {
    			 	 		echo $row->namaKos; }?>
    			 	 	</h2>
    			 	 	<hr class="small" style="border-color: black;">
                    	<br>
    			 	</div>
    			 	<table class="table" style="border: none;">
    			 		<thead>
    			 			<tr>
    			 				<th>Jenis Kamar</th>
    			 				<th><?php foreach ($detailKamar as $row) {
    			 					echo $row->jenisKamar;}?>
    			 				</th>
    			 			</tr>
    			 		</thead>
    			 		<tbody>
    			 			<tr>
    			 				<th>Fasilitas Kamar</th>
	    			 			<th><?php foreach ($fasilitasKamar as $row) {?>-
	    			 				<?php echo $row->namaFasilitasKamar;?><br>
	    			 			<?php }?></th>
    			 			</tr>
    			 			<tr>
    			 				<th>Fasilitas Kos</th>
	    			 			<th><?php foreach ($fasilitasKos as $row) {?>-
	    			 				<?php echo $row->namaFasilitasKos;?><br>
	    			 			<?php }?></th>
    			 			</tr>
    			 			<tr>
    			 				<th>Tipe Kos</th>
	    			 			<th><?php foreach ($tipeKos as $row) {?>
	    			 				<?php echo $row->tipeKos;?><br>
	    			 			<?php }?></th>
    			 			</tr>
    			 			<?php
    			 				foreach($detailKos as $row){ ?>
    			 					<tr>
    			 						<th>Alamat Kos</th>
    			 						<th><?php echo $row->alamatKos ?></th>
    			 					</tr>
    			 					<tr>
    			 						<th>Telepon Kos</th>
    			 						<th><?php echo $row->teleponKos ?></th>
    			 					</tr>
    			 				<?php } ?>
    			 			<tr>
    			 				<th>Harga Kamar</th>
	    			 			<th>Rp<?php echo number_format($harga) ?></th>
    			 			</tr>
    			 		</tbody>
    			 	</table>
    			</div>
    		</div>
    	</aside>
    	<aside class="call-to-action ">
    		<div class="container">
    			 <div class="row">
    			 </div>
    		</div>
    	</aside>
	</body>
</html>