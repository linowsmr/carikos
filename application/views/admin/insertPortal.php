<!DOCTYPE html>
<html>
<head>
   <title> Form Akses Jalan </title>
</head>
<body>

</body>
</html>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tambah Portal</h1>
        </div>
    </div>
    <form action="<?php echo site_url('admin/insertPortal')?>" method="POST">
 
			<h5>Jenis Kendaraan: </h5> <select name="jeniskendaraan">
				 <option value="Semua Kendaraan">Semua Kendaraan</option>
				 <option value="Mobil">Mobil</option>
				 <option value="Motor">Motor</option>
			</select>
			<br>
			<h5>Latitude: </h5> <input type="text" name="lat"></input>
			<br>
			<h5>Longitude: </h5> <input type="text" name="lng"></input>
			<br>
			<h5>Akses Portal: </h5> <input type="text" name="aksesportal"></input>
			<br>
			<h5>Waktu Buka Portal: </h5> <input type="text" name="waktubuka"></input>
			<br>
			<h5>Waktu Tutup Portal: </h5> <input type="text" name="waktututup"></input>
			<br>
			<br>
		<button type="submit" class="btn btn-success btn-sm">SUBMIT</button>
 
	</form>
</div>