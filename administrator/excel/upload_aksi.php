<?php 
// menghubungkan dengan koneksi
include '../config.php';
// menghubungkan dengan library excel reader
include "excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['filepeserta']['name']) ;
move_uploaded_file($_FILES['filepeserta']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filepeserta']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepeserta']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nis    = $data->val($i, 1);
	$nama   = $data->val($i, 2);
	$kelas  = $data->val($i, 3);

	if($nis != "" && $nama != "" && $kelas != ""){
		// input data ke database (table peserta)
		mysqli_query($koneksi,"INSERT into peserta values('','$nis','$nama','$kelas','')");
		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepeserta']['name']);

// alihkan halaman ke index.php
header("location:../kartu.php");
?>