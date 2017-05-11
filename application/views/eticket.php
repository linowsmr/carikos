<?php
require_once('assets/TCPDF/examples/tcpdf_include.php');
require_once('assets/TCPDF/tcpdf.php');

foreach ($eticket as $row) {
	$idTransaksi = $row->idTransaksi;
	$tanggalMasuk = $row->tanggalMasuk;
	$tanggalKeluar = $row->tanggalKeluar;
	$jenisKamar = $row->jenisKamar;
	$namaKos = $row->namaKos;
	$alamatKos = $row->alamatKos;
	$teleponKos = $row->teleponKos;
	$namaFileKamar = $row->namaFileKamar;
	$namaFile = $row->namaFile;
	$namaAkun = $row->namaAkun;
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT, true, 'UTF-8',false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CariKos');
$pdf->SetTitle('e-ticket');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '',PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->SetFooterData(array(0,64,0), array(0,64,128));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->setFontSubsetting(true);

$pdf->SetFont('times', '', 8, '', true);
$pdf->setCellHeightRatio(0.5);

$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


// Set some content to print
$gambar='
<img src="'.base_url().'assets/images/kos/'.$namaFile.'" style="width:350px;"/>
';

$detail='
<p style="font-size:14px;"><i>Nama</i></p>
<h2>'.$namaAkun.'</h2>
</br>
<p style="font-size:14px;"><i>Jenis Kamar</i></p>
<h2>'.$jenisKamar.'</h2>
</br>
<p style="font-size:14px;"><i>Tanggal Masuk</i></p>
<h2>'.$tanggalMasuk.'</h2>
</br>
<p style="font-size:14px;"><i>Tanggal Keluar</i></p>
<h2>'.$tanggalKeluar.'</h2>
</br>
';

$head = '
<body>
	<div>
		<h1 style="text-align: center; font-size: 30px;">E-TICKET</h1>
		<p style="text-align: center; font-size: 30px;">Pemesanan Indekos</p>
		<hr>
		</br> 
		<h1>ID TRANSAKSI : '.$idTransaksi.'</h1>
		</br>
		<h1>Indekos '.$namaKos.'</h1>
		</br>
		<p style="font-style:italic; font-size:12px;">'.$alamatKos.'</p>
		<p style="font-size:12px;">'.$teleponKos.'</p>
		<hr>
	</div>
</body>
';

$head1 = '
<h1>Indekos '.$namaKos.'</h1>
<p style="font-style:italic; font-size:12px;">'.$alamatKos.'</p>
<p style="font-size:12px;">'.$teleponKos.'</p>
';

$tglMasuk ='
<h3>Tanggal Masuk</h3>
<h3>'.$tanggalMasuk.'</h3>
';

$tglKeluar ='
<h3>Tanggal Keluar</h3>
<h3>'.$tanggalKeluar.'</h3>
';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '30', $head, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '85', $detail, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '110', '85', $gambar, 0, 1, 0, true, '', true);
//$pdf->writeHTMLCell(0, 0, '80', '55', $head1, 0, 1, 0, true, '', true);
//$pdf->writeHTMLCell(100, 0, '100', '70', $tglMasuk, 0, 1, 0, true, '', true);
//$pdf->writeHTMLCell(100, 0, '150', '70', $tglKeluar, 0, 1, 0, true, '', true);
//$pdf->writeHTMLCell(100, 0, '100', '30', $html, 0, 1, 0, true, '', true);


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');
?>