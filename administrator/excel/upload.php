<!DOCTYPE html>
<html>
<head>
	<title>Import Excel</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}

	p{
		color: green;
	}
	.add{
		background:#333;
		color:white;
		padding:5px 10px;
		margin:5px 0px;
		border-radius:5px;
		text-decoration: none;
		cursor: pointer;
	}
	input[type="file"]{
		padding: 10px;
	}
</style>
<h2>IMPORT DATA DARI EXCEL</h2>

<?php 
include '../config.php';
?>

<form method="post" enctype="multipart/form-data" action="upload_aksi.php">
	Pilih File: 
	<input name="filepeserta" type="file" required="required"> 
	<input name="upload" type="submit" value="Import" class="add">
</form>

<br/>
<i>Keterangan : Pastikan file berextensi <b>.xls</b></i>
<br/><br/>
<a href="../kartu.php" class="add">Kembali</a>
<br/>
</body>
</html>