<?php
if(isset($_POST["image"])){
	$nf=$_GET['nf'];
	if($nf<>""){
	unlink("../photo/".$nf);
	}
	$tempdir = "../photo/";
    if (!file_exists($tempdir))
      mkdir($tempdir);

	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$nis=$_GET['nis'];
	$nama=addslashes(htmlspecialchars($_GET['nama']));
	$halaman=$_GET['halaman'];
	$nm=str_replace(" ","-",$nama);
	$imageName = $tempdir . $nis . date('Ymd') . time() . '.png';
	file_put_contents($imageName, $data);
	$id=time();
	$photo=substr($imageName,9,50);
	include "config.php";
	$sqlx="UPDATE peserta SET photo='$photo' where nis='$nis'";
	$simpan=mysqli_query($koneksi,$sqlx);
	// echo '<img src="'.$imageName.'" class="img-thumbnail" />';
	
	?>
	<meta http-equiv="refresh" content="1;url=kartu.php?halaman=<?= $halaman ?>">
	<?php
}
?>
