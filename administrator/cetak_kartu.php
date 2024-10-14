<html>
<head>
<title> Kartu Peserta </title>
<style>
body{
	font-family: Calibri;
	background:white;
}
@font-face {
    font-family: ArialNarrow;
    src: url("../font/ARIALN.TTF");
}
#luar{
	width:295mm;
	overflow: hidden;
	margin:2mm auto;
	padding:0mm;
	/* transform: rotateY(180deg); */

}
#kartu-kiri{
	width:53mm;
	height:85mm;
	padding:0mm;
	margin:5mm 2mm;
	border:1px #eee solid;
	background-image:url('../gambar/kartu.png');
	background-repeat:no-repeat;
	background-size: 53mm 85mm;
	float:left;
}
#identitas{
	width:45mm;
	overflow:hidden;
	padding:24mm 5mm 2mm 5mm;
	margin:0mm;
	text-align:center;
	font:6pt "Calibri";
}
#identitas td{
	padding:1px;
}

big{
	font:7pt "Calibri";
	font-weight:bold;
	line-height:100%;
	color:#4d4d4d;
}
small{
	font:6pt "Calibri";
	line-height:100%;
	color:#4d4d4d;
}
.td{
	text-align:justify;
}
#plat{
	height:5mm;
	width:100%;
	background:#000;
	position:relative;
	padding:0px;
	margin:0px;
	float:left;
}
.arial{
	font:6.5pt "ArialNarrow";
	line-height: 100%;
	color:#4d4d4d;
}
.pasphoto{
	width:17mm;
	height:23mm;
	border-radius:10px;
	border:1.5px #fff solid;
}
</style>
</head>
<body>
<div id="luar">
<?php
include "config.php";
include('barcode128.php'); 
$batas=5;
$halaman=$_GET['halaman'];
		if(empty($halaman))
		{
			$posisi=0;
			$halaman=1;
		}
		else
		{
			$posisi = ($halaman-1) * $batas;
		}
		include "config.php";
		$sql="select * from peserta order by id_peserta asc";
		$result=mysqli_query($koneksi,$sql);
		$no=$posisi+1;
		while($data=mysqli_fetch_array($result)){
		$nama=$data['nama'];
		$nm=preg_replace("/[^a-zA-Z0-9' ]/", "", $nama);
		$nm_kapital=strtoupper($nm);

?>
	<div id="kartu-kiri">
		<div id="identitas">
			<table width="100%">
				<tr>
					<td valign="top" align="center">
						<img src="../photo/<?= $data['photo'] ?>" class="pasphoto">&nbsp;
					</td>
				</tr>
				<tr>
					<td align="center" style="font:7pt 'Calibri'">
					<?= bar128(stripslashes($data['nis'])) ?>
					</td>
				</tr>
				<tr>
					<td align="center">
						<b style="font:12pt 'Calibri'; font-weight:bold;"><?= $nm_kapital ?></b><br>
						<b style="font:9pt 'Calibri'"><?= $data['kelas'] ?></b>
					</td>
					
				</tr>
				
			</table>
		</div>
	</div>
	
<?php } ?>
</div>
</body>
</html>
<script>
	window.print();
</script>