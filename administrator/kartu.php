<!DOCTYPE html>
<html>
<head>
	<title>Program Pembuatan KTM</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    <link rel="icon" href="../gambar/skaone.png">
	<style>
		body{
			font:14px "Calibri";
		}
		.jdlkolom{
			background:green;
			color:white;
		}
		.baris{
			background:#fff;
		}
		.baris:hover{
			background:orange;
		}
		img{
			border-radius:5px;
		}
		h2{
			color:green;
			font:30px "Calibri";
			font-weight:bold;
			margin-bottom:10px;
		}
		form{
			width:400px;
			margin:50px auto;
			padding:10px;
			border-radius:5px;
			box-shadow:0px 0px 10px 2px #333;
			background:white;
		}
		.add{
			background:#333;
			color:white;
			padding:5px 10px;
			margin:5px 0px;
			border-radius:5px;
			text-decoration: none;
		}
		.edit{
			background:green;
			color:white;
			padding:5px 10px;
			margin:5px 0px;
			border-radius:5px;
			text-decoration: none;
		}
		.hapus{
			background:red;
			color:white;
			padding:5px 10px;
			margin:5px 0px;
			border-radius:5px;
			text-decoration: none;
		}
		.status-0{
			background:#4d4d4d;
			color:white;
			padding:5px 10px;
			margin:5px 0px;
			border-radius:5px;
			text-decoration: none;
		}
		.status-1{
			background:blue;
			color:white;
			padding:5px 10px;
			margin:5px 0px;
			border-radius:5px;
			text-decoration: none;
		}
		.add:hover, .edit:hover, .hapus:hover, .status-1:hover, .status-0:hover{
			background:black;
		}
		#popup {
		width: 100%;
		height: 100%;
		position: fixed;
		background: rgba(0,0,0,.6);
		top: 0;
		left: 0;
		z-index: 9999;
		visibility: hidden;
		}
		#popup:target {
		visibility: visible;
		}
		.window {
		overflow: auto;
		position: relative;
		padding: 20px;
		border-radius:5px;
		width:440px;
		margin:0px auto;
		top: 50%;
		-webkit-transform: translateY(-50%);
		-o-transform: translateY(-50%);
		transform: translateY(-50%);
		}
		.page-1{
		background:green;
		color:white;
		padding:5px 10px;
		font:12px "Calibri";
		border-radius:3px;
		margin:0px 5px 0px 0px;
		text-decoration:none;
		}
		.page-0{
		background:#333;
		color:white;
		padding:5px 10px;
		font:12px "Calibri";
		border-radius:3px;
		margin:0px 5px 0px 0px;
		text-decoration:none;
		}
		.page-0:hover{
		background:orange;
		}
		.belum-cetak{
			background:#333;
			color:white;
			font:14px "Calibri";
			padding:7px 20px;
			border-radius:30px;
			text-decoration: none;
			box-shadow: 0px 0px 10px 0px #4d4d4d;
			border:2px white solid; 
			margin:0px 5px 0px 0px;
		}
		.sudah-cetak{
			background:blue;
			color:white;
			font:14px "Calibri";
			padding:7px 20px;
			border-radius:30px;
			text-decoration: none;
			box-shadow: 0px 0px 10px 0px #4d4d4d;
			border:2px white solid;
		}
		.belum-cetak:hover, .sudah-cetak:hover{
			background:orange;
		}
		form{
			width:400px;
			margin:50px auto;
			padding:10px;
			border-radius:5px;
			box-shadow:0px 0px 10px 2px #333;
			background:white;
		}
		input[type="text"]{
			width:250px;
			padding:5px;
			border:none;
			border-bottom: 1px #ccccb3 solid;
			border-top: 1px #ccccb3 solid;
			border-left: 1px #ccccb3 solid;
			border-right: 1px #ccccb3 solid;
			text-decoration: none;
			outline: none;
		}
		textarea{
			width:250px;
			height:40px;
			padding:5px;
			border:none;
			border-bottom: 1px #ccccb3 solid;
			border-top: 1px #ccccb3 solid;
			border-left: 1px #ccccb3 solid;
			border-right: 1px #ccccb3 solid;
			font:14px "Calibri";
			text-decoration: none;
			outline: none;
		}
		input[type="file"]{
			width:250px;
			padding:5px;
			border:none;
			border-bottom: 1px #ccccb3 solid;
			border-top: 1px #ccccb3 solid;
			border-left: 1px #ccccb3 solid;
			border-right: 1px #ccccb3 solid;
		}
		input[type="submit"]{
			padding:5px 10px;
			background:orange;
			color:white;
			border-radius:3px;
			border:none;
		}
		.batal{
			padding:4px 10px;
			background:red;
			color:white;
			border-radius:3px;
			text-decoration:none;
		}
		input[type="submit"]:hover, .batal:hover{
			background:#333;
		}
		h2{
			font:25px "Calibri";
			color:green;
			font-weight:bold;
			margin:5px;
		}
		.list{
			padding:5px 7px;
			font:12px "Arial";
			width:280px;
			border:none;
			border-left:1px #ccc solid;
			border-right:1px #ccc solid;
			border-top:1px #ccc solid;
			border-bottom:1px #ccc solid;
			}
		
	</style>
</head>
<body>
<?php
    include "config.php";
    $batas=10;
    $hal="select * from peserta";
	$hsl=mysqli_query($koneksi,$hal);
	$jmldt=mysqli_num_rows($hsl);
	if($jmldt % $batas == "1"){
		$jhal=($jmldt-1)/$batas;
	}
	else{
		$jhal=$jmldt/$batas;	
	}
	$jmlhal=ceil($jhal);

?>
	<h2>Katu Peserta Ujian</h2>
	<table width="100%" border="0" cellpadding="5" cellspacing="1">
		<tr class="jdlkolom">
			<th width="40">No.</th>
			<th width="90">NIS</th>
			<th>Nama Siswa</th>
			<th width="200">Kelas</th>
			<th width="50">Photo</th>
			<th width="150">Aksi</th>
		</tr>
		<?php  
		if(isset($_GET['halaman'])){
			$halaman=$_GET['halaman'];
		}else{
			$halaman=$jmlhal;
		}
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
			$sql="select * from peserta order by id_peserta asc limit $posisi,$batas";
				
		$result=mysqli_query($koneksi,$sql);
		$no=$posisi+1;
		while($data=mysqli_fetch_array($result)){
			$nama=$data['nama'];
			$nm=preg_replace("/[^a-zA-Z0-9' ]/", "", $nama);
			$nm_kapital=strtoupper($nm);
		?>
		<tr class="baris">
			<td align="center"><?= $no ?></td>
			<td align="center"><?= $data['nis'] ?></td>
			<td><?= $nm_kapital ?></td>
			<td><?= $data['kelas'] ?></td>
			<td align="center">
				<a href="kartu.php?aksi=detail&nf=<?= $data['photo'] ?>&halaman=<?= $halaman ?>#popup"><img src="../photo/<?= $data['photo'] ?>" width="40"></a>
			</td>
			<td align="center">
				<a href="kartu.php?aksi=edit&id=<?= $data['id_peserta'] ?>&halaman=<?= $halaman ?>#popup" class="edit">Edit</a> 
				<a href="kartu.php?aksi=hapus&id=<?= $data['id_peserta'] ?>&nf=<?= $data['photo'] ?>&halaman=<?= $halaman ?>#popup" class="hapus" onclick="return confirm('Apakah anda yakin data <?= $data['nama'] ?> akan dihapus?')">Del</a> 
			</td>
		</tr>
		<?php $no++; } ?>
	</table>
	<p>
	<!-- <a href="kartu.php?aksi=form&halaman=<?= $jmlhal ?>#popup" class="add">[+] Data Peserta</a>  -->
	<!-- <a href="" class="add">[+] Data Peserta</a>-->
	<a href="excel/upload.php" class="add">Import Data Excel</a>
	<a href="cetak_kartu.php?halaman=<?= $halaman ?>" class="add" target="blank">Cetak Kartu</a>


<p align="center">
	<?php
	$file="kartu.php";

	if(isset($_GET['status'])){
			$status=$_GET['status'];
			if($status=="1"){
				$tampil2="select * from ktm where status='1'";
			}else{
				$tampil2="select * from ktm where status='0'";
			}
		}
	else
	{
		$tampil2="select * from peserta";
	}
	$hasil2=mysqli_query($koneksi,$tampil2);
	$jmldata=mysqli_num_rows($hasil2);

	$jmlhalaman=ceil($jhal);

	//link ke halaman sebelumnya (previous)
	if($halaman > 1)
	{
		$previous=$halaman-1;
		echo "<A HREF=$file?halaman=1 class=\"page-0\"><< First</A> 
	        <A HREF=$file?halaman=$previous class=\"page-0\">< Previous</A>";
	}
	else
	{ 
		echo "<b class=\"page-1\"><< First</b><b class=\"page-1\">< Previous</b>";
	}

	$angka=($halaman > 3 ? "<b class=\"page-0\">...</b>" : "");
	for($i=$halaman-2;$i<$halaman;$i++)
	{
	  if ($i < 1) 
	      continue;
	  $angka .= "<a href=$file?halaman=$i class=\"page-0\">$i</A> ";
	}

	$angka .= " <b class=\"page-1\">$halaman</b> ";
	for($i=$halaman+1;$i<($halaman+3);$i++)
	{
	  if ($i > $jmlhalaman) 
	      break;
	  $angka .= "<a href=$file?halaman=$i class=\"page-0\">$i</A>";
	}

	$angka .= ($halaman+2<$jmlhalaman ? "<b class=\"page-0\">...</b>  
	          <a href=$file?halaman=$jmlhalaman class=\"page-0\">$jmlhalaman</A>" : "");

	echo "$angka";

	//link kehalaman berikutnya (Next)
	if($halaman < $jmlhalaman)
	{
		$next=$halaman+1;
		echo "<A HREF=$file?halaman=$next class=\"page-0\">Next ></A>
		<A HREF=$file?halaman=$jmlhalaman class=\"page-0\">Last >></A>";
	}
	else
	{ 
		echo "<b class=\"page-1\">Next ></b><b class=\"page-1\">Last >></b>";
	}

	?>
	<p>
		

<div id="popup">
	<div class="window">
		<?php 
		$halaman=$_GET['halaman'];
		$aksi=$_GET['aksi'];
		if($aksi=="form"){
			?>

			<form action="kirim2.php?halaman=<?= $halaman ?>" method="POST">
	<table>
		<tr>
			<td align="center">
				<input list="nis" name="nis" class="list" placeholder="Masukkan NIM / Nama Mahasiswa" autocomplete="off" style="outline: none;">
			  	<datalist id="nis">
			  	<?php
			  	$sqlnim="select * from siswa order by nis asc";
			  	$resnim=mysqli_query($koneksi,$sqlnim);
			  	while($datanim=mysqli_fetch_array($resnim)){
			  	?>
			  	<option value="<?php echo $datanim['nis'] ?>"> <?php echo $datanim['nama_siswa'] ?>
			  	</option>
			  	<?php	
			  	}
			  	?>
			  	</datalist> <input type="submit" name="kirim" value="OK"> <a href="ktm.php?halaman=<?= $halaman ?>" class="batal">Batal</a>
			</td>
		</tr>		
	</table>
	
</form>
		

		<?php 
			
		}
		else if($aksi=="edit"){

			//include "ktm_edit.php";
			include "config.php";
			$id=$_GET['id'];
			$halaman=$_GET['halaman'];
			$sql="select * from peserta where id_peserta='$id'";
			$result=mysqli_query($koneksi,$sql);
			$data=mysqli_fetch_array($result);
			?>
			<form action="kartu.php?aksi=update&halaman=<?= $halaman ?>#popup" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?= $data['id_peserta'] ?>">


	<table>
		<tr>
			<th colspan="2"><h2>Edit Data Kartu</h2></th>
		</tr>
		<tr>
			<td width="150">NIM</td>
			<td><input type="hidden" name="nis" value="<?= $data['nis'] ?>"><input type="text" name="nis" value="<?= $data['nis'] ?>" disabled></td>
		</tr>
		<tr>
			<td>Nama Siswa</td>
			<td><input type="text" name="nama" value="<?= $data['nama'] ?>"></td>
		</tr>
		<tr>
			<td>Kelas</td>
			<td><input type="text" name="kelas" value="<?= $data['kelas'] ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><a href="kirim3.php?nis=<?= $data['nis'] ?>&halaman=<?= $halaman ?>&nf=<?= $data['photo'] ?>" title="Ganti Photo"><img src="../photo/<?= $data['photo'] ?>" width="150"></a></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="upload" value="Update"> <a href="kartu.php?halaman=<?= $halaman ?>" class="batal">Batal</a>
			</td>
		</tr>		
	</table>
</form>
<?php
		}
		else if($aksi=="update"){
			include 'config.php';
			$halaman=$_GET['halaman'];
			if($_POST['upload']){
				$id=$_POST['id'];
				$nis=$_POST['nis'];
				$nama=$_POST['nama'];
				$kelas=$_POST['kelas'];
				$sqlx="update peserta set nama='$nama', kelas='$kelas' where nis='$nis'";
				$edit=mysqli_query($koneksi,$sqlx);
				echo "<script> alert('Data Berhasil Di Update') </script>"; 
			}
			?>
			<meta http-equiv="refresh" content="1;url=kartu.php?halaman=<?= $halaman ?>">
			<?php
		}
	
		else if($aksi=="hapus"){
			$id=$_GET['id'];
$nf=$_GET['nf'];
include "config.php";
unlink("../photo/".$nf);
$sqlx="delete from peserta where id_peserta='$id'";
$hapus=mysqli_query($koneksi,$sqlx);
if($hapus){
	echo "<script> alert('Data Berhasil Dihapus') </script>";
}else{
	echo "<script> alert('Data Gagal Dihapus') </script>";
}
?>
<meta http-equiv="refresh" content="1;url=kartu.php?halaman=<?= $halaman ?>">
<?php
}
		else if($aksi=="detail"){
			$nf=$_GET['nf'];
		?>
		<center>
		<img src="../photo/<?= $nf ?>" width="350"><p>
		<a href="kartu.php?halaman=<?= $halaman ?>" class="hapus">Close</a>
		</center>
		<?php
		}
		else if($aksi=="status0"){
			$id=$_GET['id'];
			$halaman=$_GET['halaman'];
			$sqlr="update ktm set status='1' where id_ktm='$id'";
			$rubah=mysqli_query($koneksi,$sqlr);
			if($rubah){
				echo "<form><center>Tunggu Data sedang Dirubah.....</center></form>";
			}
			?><meta http-equiv="refresh" content="2;url=kartu.php?halaman=<?= $halaman ?>"><?php
		}
		else if($aksi=="status1"){
			$id=$_GET['id'];
			$halaman=$_GET['halaman'];
			$sqlr="update ktm set status='0' where id_ktm='$id'";
			$rubah=mysqli_query($koneksi,$sqlr);
			if($rubah){
				echo "<form><center>Tunggu Data sedang Dirubah.....</center></form>";
			}
			?><meta http-equiv="refresh" content="2;url=kartu.php?halaman=<?= $halaman ?>"><?php
		}
		?>
	</div>
</div>

</body>
</html>