<?php
if(isset($_POST["image"])){
	$tempdir = "../photo/";
    if (!file_exists($tempdir))
      mkdir($tempdir);

	$data = $_POST["image"];
	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$nim=$_GET['nis'];
	$nama=$_GET['nama'];
	$halaman=$_GET['halaman'];
	$nm=str_replace(" ","-",$nama);
	$imageName = $tempdir . $nim . date('Ymd') . '.png';
	file_put_contents($imageName, $data);
	$id=time();
	$photo=substr($imageName,9,50);
	include "config.php";
	$sqlx="INSERT INTO ktm VALUES('$id', '$nim','$photo','0')";
	$simpan=mysqli_query($koneksi,$sqlx);
	// echo '<img src="'.$imageName.'" class="img-thumbnail" />';
	?>
	<meta http-equiv="refresh" content="1;url=ktm.php?halaman=<?= $halaman ?>">
	<?php
}
?>
